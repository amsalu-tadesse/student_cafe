<?php

namespace App\Controller;

use App\Entity\Checkin;
use App\Entity\IllegalChekinAttempt;
use App\Entity\Schedule;
use App\Entity\Student;
use App\Form\CollegeType;
use App\Repository\CollegeRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @Route("/scanning")
 */
class ScanningController extends AbstractController
{
    /**
     * @Route("/", name="scanning", methods={"GET","POST"})
     */
    public function index(Request $request, KernelInterface $kernel): Response
    {
        $barcode = $request->request->get("barcode");


        $reason = null;
        $allowed = 0; //default nothing.
        $previousImage = null;
        $photo = null;
        $student = '';
        $today = date('Y-m-d');
        $em = $this->getDoctrine()->getManager();
        if($barcode)
        {
            $student = $em->getRepository(Student::class)->findOneBy(['barcode' => $barcode]);
        }
      
        $schedule = $em->getRepository(Schedule::class)->findOneBy(['status' =>1,'date'=>$today]);//active
        $all_todays_schedule = $em->getRepository(Schedule::class)->findBy(['date'=>$today]);//get the three schedules of the day.
        $today_is_completed = false;



        if (!$schedule) {
            if (sizeof($all_todays_schedule) > 0) {
                $reason = "Schedule completed";
                $allowed = 0;
                $today_is_completed = true;
                return $this->render('student/scanning.html.twig', [
                    'allowed' => $allowed,
                    'reason' => $reason,
                    'fileName' => $photo,
                    'previousImage' => $photo,
                    'student' => $student,
                    'all_todays_schedule' => $all_todays_schedule,
                    'today_is_completed' => $today_is_completed,
                ]);
            }
            else //there is no schedule created for today. create it now.
            {
                $breakfast = new Schedule();
                $lunch = new Schedule();
                $dinner = new Schedule();

                $breakfast->setDate($today);
                $breakfast->setType(1);
                $breakfast->setStatus(1);

                $lunch->setDate($today);
                $lunch->setType(2);
                $lunch->setStatus(0);

                $dinner->setDate($today);
                $dinner->setType(3);
                $dinner->setStatus(0);

                $em->persist($breakfast);
                $em->persist($lunch);
                $em->persist($dinner);

                $em->flush();
                return $this->redirectToRoute('scanning');
            }
        }





        if ($barcode == "") {
            $allowed = 0; //default.
        }

        //check if card is really available in the system.
        elseif ($student) {
            //check if this card has been used.
            $checkin = $em->getRepository(Checkin::class)->findOneBy(['student' => $student, 'schedule'=>$schedule]);

            $photo = $student->getPhoto();

            if ($checkin) {
                //$previousImage = $checkin->getPhoto();
                $reason = "ያገለገለ ካርድ | Used Card";
                $allowed = 2; //deny
            } else {
                //allow entry
                $allowed = 1; //success
                $checkin =  new Checkin();
                $checkin->setStudent($student);
                $checkin->setCheckinTime(new DateTime());
                $checkin->setScanner($this->getUser());
                $checkin->setSchedule($schedule);
                $em->persist($checkin);
            }
        } else {
            $reason = "የማይታውቅ ካርድ | Invalid Card";
            $allowed = 2; //deny
        }

        if ($allowed == 2) {
            $illegalLoginAttempt = new IllegalChekinAttempt();
            $illegalLoginAttempt->setCheckinTime(new DateTime());
            $illegalLoginAttempt->setScanner($this->getUser());
            $illegalLoginAttempt->setReason($reason);
            $illegalLoginAttempt->setSchedule($schedule);
            $illegalLoginAttempt->setBarcode($barcode);
            if ($student) {
                $illegalLoginAttempt->setStudent($student);
            }
            $em->persist($illegalLoginAttempt);
        }
        $em->flush();






        //check barcode and set allowed to true or false;

        return $this->render('student/scanning.html.twig', [
            'allowed' => $allowed,
            'reason' => $reason,
            'fileName' => $photo,
            'previousImage' => $photo,
            'student' => $student,
            'all_todays_schedule' => $all_todays_schedule,
            'today_is_completed' => $today_is_completed,

        ]);
    }
}
