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
        $reason = "ያገለገለ ካርድ";
        //check barcode and set allowed to true or false;

        return $this->render('student/scanning.html.twig', [
           'allowed'=>$barcode,
           'reason'=> $reason
        ]);
    }

    
}
