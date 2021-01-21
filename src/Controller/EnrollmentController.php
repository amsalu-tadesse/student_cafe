<?php

namespace App\Controller;

use App\Entity\Enrollment;
use App\Form\EnrollmentType;
use App\Repository\EnrollmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/enrollment")
 */
class EnrollmentController extends AbstractController
{
    /**
     * @Route("/", name="enrollment_index", methods={"GET"})
     */
    public function index(EnrollmentRepository $enrollmentRepository): Response
    {
        return $this->render('enrollment/index.html.twig', [
            'enrollments' => $enrollmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="enrollment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $enrollment = new Enrollment();
        $form = $this->createForm(EnrollmentType::class, $enrollment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enrollment);
            $entityManager->flush();

            return $this->redirectToRoute('enrollment_index');
        }

        return $this->render('enrollment/new.html.twig', [
            'enrollment' => $enrollment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enrollment_show", methods={"GET"})
     */
    public function show(Enrollment $enrollment): Response
    {
        return $this->render('enrollment/show.html.twig', [
            'enrollment' => $enrollment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enrollment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Enrollment $enrollment): Response
    {
        $form = $this->createForm(EnrollmentType::class, $enrollment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enrollment_index');
        }

        return $this->render('enrollment/edit.html.twig', [
            'enrollment' => $enrollment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enrollment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Enrollment $enrollment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enrollment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enrollment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enrollment_index');
    }
}
