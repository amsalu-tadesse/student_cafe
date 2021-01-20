<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeedController extends AbstractController
{
    /**
     * @Route("/seed", name="seed")
     */
    public function index(Request $request): Response
    {
      die;
  $em =$this->getDoctrine()->getManager();
  $prog =  $em->getRepository(Program::class)->find(1);
  $max = 3000;
for ($i=0; $i < $max; $i++) { 
  $student = new Student();
  $student->setFirstName($this->generate_random_letters(6));
  $student->setmiddleName($this->generate_random_letters(6));
  $student->setLastName($this->generate_random_letters(6));
  $student->setSex("Male");
  $student->setProgram($prog);
  $student->setYear(5);
  $student->setAcademicYear('2018/19');
  $em->persist($student);
}

$em->flush();
      
return new Response("Seeding done successfully.");


        // return $this->render('camera/index.html.twig', [
        //     'controller_name' => 'CameraController',
        // ]);
    }


    function generate_random_letters($length)
    {
        $em  = $this->getDoctrine()->getManager();
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(rand(ord('a'), ord('z')));
        }

        return $random;
    }
}
