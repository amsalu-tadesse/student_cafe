<?php

namespace App\Controller;

use App\Entity\Checkin;
use App\Entity\Card;
use App\Entity\IllegalChekinAttempt;
use App\Form\CollegeType;
use App\Repository\CollegeRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/scanning")
 */
class ScanningController extends AbstractController
{
    /**
     * @Route("/", name="scanning", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $barcode = $request->request->get("barcode");


        $reason = null;
        $allowed = 0; //default nothing.
        $fileName = uniqid() . '.png';
        $savePhoto = true;
        // $allowed = $barcode % 2 == 0 ? 1 : 0;

        $em = $this->getDoctrine()->getManager();
        $card = $em->getRepository(Card::class)->findOneBy(['barcode' => $barcode]);

        if ($card) {
            $checkin = $em->getRepository(Checkin::class)->findOneBy(['card' => $card]);
            if ($checkin) {
                $reason = "ያገለገለ ካርድ | Used Card";
                $allowed = 2; //deny
            } else {
                //allow entry
                $allowed = 1;
                $checkin =  new Checkin();
                $checkin->setCard($card);
                $checkin->setCheckinTime(new DateTime());
                $checkin->setScanner($this->getUser());
                $checkin->setPhoto($fileName);
                $em->persist($checkin);
                
              
            }
        } elseif ($barcode == "") {

            $allowed = 0; //default.
            $savePhoto = false;
        } else {
            $reason = "የማይታውቅ ካርድ | Invalid Card";
            $allowed = 2; //deny
        }

        if ($allowed == 2) {
            $illegalLoginAttempt = new IllegalChekinAttempt();
            $illegalLoginAttempt->setCheckinTime(new DateTime());
            $illegalLoginAttempt->setScanner($this->getUser());
            $illegalLoginAttempt->setReason($reason);
            $illegalLoginAttempt->setPhoto($fileName);
            $illegalLoginAttempt->setBarcode($barcode);
            if ($card) {
                $illegalLoginAttempt->setCard($card);
            } 
            $em->persist($illegalLoginAttempt);
        }
        $em->flush();

        $img = $request->request->get("image");
        if($savePhoto && $img)
        {
            $folderPath = "/var/www/gradution/public/uploads/";
            $image_parts = explode("base64,", $img);
            // $image_type_aux = explode("image/", $image_parts[0]);
            // $image_type = $image_type_aux[1];
            if (sizeof($image_parts) > 1) {
                $image_base64 = base64_decode($image_parts[1]);
                $file = $folderPath . $fileName;
                file_put_contents($file, $image_base64);
            }
        }
        
        


        //check barcode and set allowed to true or false;

        return $this->render('student/scanning.html.twig', [
            'allowed' => $allowed,
            'reason' => $reason,
            'fileName' => $fileName
        ]);
    }
}
