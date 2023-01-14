<?php

namespace App\Controller;

use App\Entity\Employees;
use App\Form\EmployeeType;
use App\Repository\EmployeesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function new(): Response
    {
        $employee = new Employees();
        $form = $this->createForm(EmployeeType::class, $employee);

        return $this->render('employees/new.html.twig', [
            'form' => $form->createView()

        ]);
    }
}
