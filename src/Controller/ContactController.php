<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\CategorieRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /*
    La methode index prend en parametre : un objet "CategorieRepository"
    Cette methode sera execute lors de l'appel de la route "app_contact"
    Cette methode nous retourne : 
        - 'categories' qui nous est utile lorsque l'on souhaite connaitre l'ensemble des categorie (par exemple dans le nav) 
*/
    #[Route('/contact', name: 'app_contact')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('contact/index.html.twig', [
            'current_menu' => 'contact',
            'categories' => $categorieRepository->findAll()
        ]);
    }
}