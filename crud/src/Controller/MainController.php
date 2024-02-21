<?php

namespace App\Controller;

use App\Form\CrudType;
use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(ArticlesRepository $repo): Response
    {
        $data = $repo-> findAll();
        return $this->render('main/accueil.html.twig', [
            'controller_name' => 'MainController',
            'data'=>$data,
        ]);
    }
        /**
     * @Route("/create", name="app_create", methods= {"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        $crud = new Articles();#entity
        $form = $this->createForm(CrudType::class, $crud) ; #creation du formulaire grace au CrudType qui est un formBuilderCrud::class pour utiliser le formulaire de la class entityCrud
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //ici on enregistre dans la base de données
            $sendDatabase= $this ->getDoctrine()->getManager();
            $sendDatabase->persist($crud);
            $sendDatabase->flush();

            $this->addFlash('notice', 'Soumission réussi !!');

            return $this->redirectToRoute('main'); #redirection vers la page d'accueil

        }

        return $this->render('main/createForm.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView()
        ]);
    }
}
