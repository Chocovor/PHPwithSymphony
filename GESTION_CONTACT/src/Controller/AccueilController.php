<?php

namespace App\Controller; /* On déclare un namespace ici-même où on 
importera des fonctions, classes, et constantes stockées ailleurs */

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/* Maintenant, toutes les classes, fonctions et constantes en provenance d'un 
autre chemin seront simplifiées en App\Controller\NomDeMaClasse par exemple*/

class AccueilController extends AbstractController
{/* L’annotation @Route ci-dessous définit une route pour la fonction index(). 
    Elle indique au code qu’il faut exécuter la fonction index() quand on accède à 
    l’URL "NOMDEMONSITE/accueil" avec la requête GET. La route s’appelle app_accueil.*/
    
    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
