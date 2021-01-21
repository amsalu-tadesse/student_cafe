<?php

namespace App\Controller;

use App\Entity\ProgramType;
use App\Form\ProgramTypeType;
use App\Repository\ProgramTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/programtype")
 */
class ProgramTypeController extends AbstractController
{
    /**
     * @Route("/", name="program_type_index", methods={"GET"})
     */
    public function index(ProgramTypeRepository $programTypeRepository): Response
    {
        return $this->render('program_type/index.html.twig', [
            'program_types' => $programTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="program_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $programType = new ProgramType();
        $form = $this->createForm(ProgramTypeType::class, $programType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($programType);
            $entityManager->flush();

            return $this->redirectToRoute('program_type_index');
        }

        return $this->render('program_type/new.html.twig', [
            'program_type' => $programType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="program_type_show", methods={"GET"})
     */
    public function show(ProgramType $programType): Response
    {
        return $this->render('program_type/show.html.twig', [
            'program_type' => $programType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="program_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProgramType $programType): Response
    {
        $form = $this->createForm(ProgramTypeType::class, $programType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('program_type_index');
        }

        return $this->render('program_type/edit.html.twig', [
            'program_type' => $programType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="program_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProgramType $programType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$programType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($programType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('program_type_index');
    }
}
