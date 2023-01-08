<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;

/*Ce controller represente une classe "AboutController", ce controller est utile à la page about*/ 


class AboutController extends AbstractController
{
    /*
    La methode index prend en parametre : un objet "CategorieRepository"
    Cette methode sera execute lors de l'appel de la route "app_about"
    Cette methode nous retourne : 
        - 'Current_menu' qui nous est utile pour spécifier dans le nav l'endroit ou l'on se trouve
        - 'categories' qui nous est utile lorsque l'on souhaite connaitre l'ensemble des categories (par exemple dans le nav) 
*/
    #[Route('/about', name: 'app_about')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('about/index.html.twig', [
            'current_menu' => 'about',
            'categories' => $categorieRepository->findAll(),
        ]);
    }
}
