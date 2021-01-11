<?php

namespace App\Controller;

use App\Entity\College;
use App\Form\CollegeType;
use App\Repository\CollegeRepository;
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
        $reason1 = "ያገለገለ ካርድ Used Card";
        $reason2 = "የመይታውቅ ካርድ Invalid Card";
        $reason = $reason2;
        $allowed = $barcode%2==0?1:0;
        //check barcode and set allowed to true or false;

        return $this->render('student/scanning.html.twig', [
           'allowed'=>$allowed,
           'reason'=> $reason
        ]);
    }

    
}
