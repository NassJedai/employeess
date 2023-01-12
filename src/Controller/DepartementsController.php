<?php

namespace App\Controller;

use App\Repository\DepartementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementsController extends AbstractController
{
    #[Route('/departements', name: 'app_departements')]
    public function index(DepartementsRepository $repository): Response
    {
        $departements = $repository->findAll();

        //dd($departements);
        return $this->render('departements/index.html.twig', [
            'departements' => $departements,
        ]);
    }
}
