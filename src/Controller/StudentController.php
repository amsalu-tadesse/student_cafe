<?php

namespace App\Controller;

use App\Entity\Department;
use App\Entity\Enrollment;
use App\Entity\ProgramLevel;
use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/", name="student_index", methods={"GET","POST"})
     */
    public function index(Request $request, StudentRepository $studentRepository,PaginatorInterface $paginator): Response
    {


        

        $f=null;
        $em =$this->getDoctrine()->getManager();
        $reset = $request->query->get('reset');
        $pg = $request->query->get('page');

        if($reset=="reset" && !$pg)
        {
           
          $request->getSession()->set('filter_student',$f);
        }
        else
        {
          $f = $request->getSession()->get('filter_student')?$request->getSession()->get('filter_student'):null;
        }

        $form=$this->createFormBuilder()
      
        ->add('Enrollment',EntityType::class, [
            'class' => Enrollment::class,
            'placeholder' => "",
            'required'=>false,
            // 'choice_value' => 'Program Type',
            // 'placeholder1' => '2013',
           /* 'query_builder' => function (EntityRepository $er) {
                $res = $er->createQueryBuilder('sg')
                    ->groupBy('sg.year');
                return $res;
            },*/
  
        ])
        ->add('Department',EntityType::class, [
            'class' => Department::class,
            'required'=>false,
            'placeholder' => "",
            // 'choice_value' => 'Department',
            // 'placeholder1' => '2013',
           /* 'query_builder' => function (EntityRepository $er) {
                $res = $er->createQueryBuilder('sg')
                    ->groupBy('sg.year');
                return $res;
            },*/
  
        ])
        /*->add('Department',EntityType::class, [
            'class' => Department::class,
            'choice_value' => 'Department',
            'placeholder' => "",
            // 'data' => 'NURSERY ',
            'required'=>false,
        
  
        ])*/
        ->add('ProgramLevel',EntityType::class, [
            'class' => ProgramLevel::class,
            'required'=>false,
            'placeholder' => "",
            // 'choice_value' => 'Program Level',
            /*'query_builder' => function (EntityRepository $er) {
                $res = $er->createQueryBuilder('s')
                    ->andWhere('s.active=1');
                return $res;
            },*/
  
        ])
   
        ->add('Search',SubmitType::class)
        // ->add('Reset',ResetType::class)
        ->getForm(); 

        $form->handleRequest($request);


        $queryBuilder = null;
        $students = null;
        if($form->isSubmitted() && $form->isValid())
        {
            $f = $request->request->get('form');
            $request->getSession()->set('filter_student',$f);
            return $this->redirectToRoute("student_index");
  
        }

         $students =  $em->getRepository(Student::class)->findByFilters($f);
  

        $pageNumber = 5;
        $data=$paginator->paginate(
            $students,
            $request->query->getInt('page',1),
            $pageNumber
        );
        // dd($data);
        return $this->render('student/index.html.twig', [
            'students' => $data,
            'filterform'=>$form->createView(),
            'filterdata'=>$f
        ]);


    

        
        /*$data=$paginator->paginate(
            $studentRepository->findAll(),
            $request->query->getInt('page',1),
            5
         );
        return $this->render('student/index.html.twig', [
            'students' => $data,
        ]);*/
    }

    /**
     * @Route("/new", name="student_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods={"GET"})
     */
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="student_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        }

        return $this->redirectToRoute('student_index');
    }
}
