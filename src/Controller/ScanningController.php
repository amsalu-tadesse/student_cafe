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
     * @Route("/", name="scanning_index", methods={"GET","POST"})
     */
    public function index(CollegeRepository $collegeRepository): Response
    {
        return $this->render('student/scanning.html.twig', [
            'colleges' => $collegeRepository->findAll(),
        ]);
    }

    
}
