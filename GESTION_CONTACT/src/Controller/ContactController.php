<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact", methods={"GET"})
     */
   
    public function index(ContactRepository  $repo) : Response 
    
    {
        // $manager = $this->getDoctrine()->getManager(); //manager gère l'envoi des éléments vers la BDD et getDoctrine fait le taxi
        // $repo = $manager->getRepository(Contact::class); // On récupère le repository de la table "Contact"
        // les deux lignes au dessus sont remplacées par les paramètres de notre fonction index
        $contacts = $repo->findAll();
        // les 3 lignes au dessus récupèrent tous les contacts de la base de données et les stockent dans une variable "contacts". 

        return $this->render('contact/listeContacts.html.twig', [
            // 'controller_name' => 'ContactController',
            "contacts"=>$contacts, //"contacts" est le nom de la variable qui sera accessible dans notre vue twig (front)
            //$contacts, variable back end 
            //donc on relie les deux
        ]);
    }
}