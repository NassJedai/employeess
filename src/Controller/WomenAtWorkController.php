<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WomenAtWorkController extends AbstractController
{
    #[Route('/women/at/work', name: 'app_women_at_work')]
    public function index(): Response
    {
        return $this->render('women_at_work/index.html.twig', [
            'controller_name' => 'WomenAtWorkController',
        ]);
    }
}
