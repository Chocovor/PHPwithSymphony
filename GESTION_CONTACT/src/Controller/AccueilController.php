<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="app_accueil", methods={"GET"})
     */
    public function index(): Response
    {
        //$nomsStudents=['Jérémie', 'Ousmane', 'Alexia', 'Chouaibou'];
       // $age = 17;
        //$nom="Stéphane";
        return $this->render('accueil/index.html.twig', [
            /*'controller_name' => 'AccueilController',*/
            //"lesNoms" => $nomsStudents, 
            //"age" => $age,
        ]);
    }
}
