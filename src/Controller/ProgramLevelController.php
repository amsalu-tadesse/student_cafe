<?php

namespace App\Controller;

use App\Entity\ProgramLevel;
use App\Form\ProgramLevelType;
use App\Repository\ProgramLevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/programlevel")
 */
class ProgramLevelController extends AbstractController
{
    /**
     * @Route("/", name="program_level_index", methods={"GET"})
     */
    public function index(ProgramLevelRepository $programLevelRepository): Response
    {
        return $this->render('program_level/index.html.twig', [
            'program_levels' => $programLevelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="program_level_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $programLevel = new ProgramLevel();
        $form = $this->createForm(ProgramLevelType::class, $programLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($programLevel);
            $entityManager->flush();

            return $this->redirectToRoute('program_level_index');
        }

        return $this->render('program_level/new.html.twig', [
            'program_level' => $programLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="program_level_show", methods={"GET"})
     */
    public function show(ProgramLevel $programLevel): Response
    {
        return $this->render('program_level/show.html.twig', [
            'program_level' => $programLevel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="program_level_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProgramLevel $programLevel): Response
    {
        $form = $this->createForm(ProgramLevelType::class, $programLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('program_level_index');
        }

        return $this->render('program_level/edit.html.twig', [
            'program_level' => $programLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="program_level_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProgramLevel $programLevel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$programLevel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($programLevel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('program_level_index');
    }
}
