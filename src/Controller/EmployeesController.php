<?php

namespace App\Controller;

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
}
