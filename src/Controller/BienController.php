<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Bien;
use App\Repository\BienRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/*Ce controller represente une classe "BienController", ce controller est utile à la page biens */
class BienController extends AbstractController
{
    /*
    La methode index prend en parametre : un objet 'Request', un objet 'BienRepository', un objet "CategorieRepository", et un objet PaginatorInterface  
    Cette methode sera execute lors de l'appel de la route "app_bien"
    Cette methode nous retourne : 
        - 'current_menu' qui nous est utile pour spécifier dans le nav l'endroit ou l'on se trouve
        - 'categories' qui nous est utile lorsque l'on souhaite connaitre l'ensemble des categorie (par exemple dans le nav) 
        - 'biens' qui nous est utile lorque l'on souhaite afficher les biens car 'biens' contient l'ensemble des biens  
    */
    #[Route('/biens', name: 'app_bien')]
    public function index(Request $request, BienRepository $bienRepository, CategorieRepository $rep, PaginatorInterface $paginator): Response
    {
        $biens = $bienRepository->findAll();
        $biens = $paginator->paginate(
            $biens,
            $request->query->getInt('page', 1), /*page number*/
            limit: 6
        );
        return $this->render('bien/index.html.twig', [
            'current_menu' => 'biens',
            'categories' => $rep->findAll(),
            'biens' => $biens
        ]);
    }

    /*
    La methode show prend en parametre : un objet 'Bien', un objet "CategorieRepository"  
    Cette methode sera execute lors de l'appel de la route "app_bien_show"
    Cette methode nous retourne : 
        - 'categories' qui nous est utile lorsque l'on souhaite connaitre l'ensemble des biens (par exemple dans le nav)  
        - 'bien' qui nous est utile lorque l'on souhaite acceder à un bien 
    */
    #[Route('/{id}/show', name: 'app_bien_show', methods: ['GET'])]
    public function show(Bien $bien, CategorieRepository $rep): Response
    {

        return $this->render('bien/partials/show.html.twig', [
            'categories' => $rep->findAll(),
            'bien' => $bien

        ]);
    }
}
