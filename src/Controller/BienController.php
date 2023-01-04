<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienController extends AbstractController
{
    #[Route('/biens', name: 'app_bien')]
    public function index(): Response
    {
        return $this->render('bien/index.html.twig', [
            'current_menu' => 'biens'
        ]);
    }
}
