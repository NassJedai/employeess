<?php

namespace App\Controller;

use App\Entity\Employees;
use App\Form\EmployeeType;
use App\Repository\EmployeesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeesController extends AbstractController
{
    #[Route('/employees', name: 'app_employees')]
    public function index(EmployeesRepository $repository): Response
    {

        $employees = $repository->findAll();
        //dd($employees);
        return $this->render('employees/index.html.twig', [
            'employees' => $employees,
        ]);
    }


    #[Route('/employee/nouveau', name:'app_employees_nouveau', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response

    {
        $employee = new Employees();
        $form = $this->createForm(EmployeeType::class, $employee);

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()) {
           $employee = $form->getData();
           $manager->persist($employee);
           $manager->flush();



            $this->addFlash(
                'success',
                'l\'employeur a été créé avec succès !'
            );

            return $this->redirectToRoute('app_employees');

        } else {

        }

        return $this->render('employees/new.html.twig', [
            'form' => $form->createView()

        ]);
    }


#[Route ('/employee/edition/{id}', 'employee.edit', methods: ['GET', 'POST'])]
    public function edit(Employees $employee, Request $request, EntityManagerInterface $manager) :Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);

        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()) {
            $employee = $form->getData();

            $manager->persist($employee);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre employée a été modifié avec succès ! '
            );

           return  $this->redirectToRoute('app_employees');
        }
        return $this->render('employees/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }




    #[Route ('/employee/supression/{id}', 'employee.delete', methods:['GET'])]
    public function delete(Employees $employees, EntityManagerInterface $manager) :Response
    {
        $manager->remove($employees);
        $manager->flush();

        $this->addFlash(
            'danger',
            'Votre employée a été supprimé ! '
        );

        return  $this->redirectToRoute('app_employees');
    }

}
