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
        $form->handleRequest($request); #applique les requête pour les appliquer au formulaire afin d'associer chaque champs aux colonnes correspondante de la table articles
        if ($form->isSubmitted() && $form->isValid()){
            //ici on enregistre dans la base de données si le formulaire est bien rempli
            $sendDatabase= $this ->getDoctrine()->getManager();
            $sendDatabase->persist($crud);
            $sendDatabase->flush();

            $this->addFlash('notice', 'Soumission réussi !!');

            return $this->redirectToRoute("app_main"); #redirection vers la page d'accueil

        }

        return $this->render('main/createForm.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
        ]);
    }
        /**
     * @Route("/update/{id}", name="app_update", methods= {"GET", "POST"})
     */
    public function update($id, Request $request): Response
    {

        $crud = $this->getDoctrine()->getRepository(Articles::class)->find($id);
        $form = $this->createForm(CrudType::class, $crud) ; #creation du formulaire grace au CrudType qui est un formBuilderCrud::class pour utiliser le formulaire de la class entityCrud
        $form->handleRequest($request); #applique les requête pour les appliquer au formulaire afin d'associer chaque champs aux colonnes correspondante de la table articles
        if ($form->isSubmitted() && $form->isValid()){
            //ici on enregistre dans la base de données si le formulaire est bien rempli
            $sendDatabase= $this ->getDoctrine()->getManager();
            $sendDatabase->persist($crud);
            $sendDatabase->flush();
            $this->addFlash('notice', 'modification réussi !!');

            return $this->redirectToRoute("app_main"); #redirection vers la page d'accueil

        }

        return $this->render('main/updateForm.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
        ]);
    }
            /**
     * @Route("/delete/{id}", name="app_delete", methods= {"GET", "POST"})
     */
    public function delete($id, Request $request, ArticlesRepository $repo): Response
    {

        //$crud = $this->getDoctrine()->getRepository(Articles::class)->find($id);
        //$form = $this->createForm(CrudType::class, $crud) ; #creation du formulaire grace au CrudType qui est un formBuilderCrud::class pour utiliser le formulaire de la class entityCrud
       //$form->handleRequest($request); #applique les requête pour les appliquer au formulaire afin d'associer chaque champs aux colonnes correspondante de la table articles
        //if ($form->isSubmitted() && $form->isValid()){
            //ici on enregistre dans la base de données si le formulaire est bien rempli
            $crud = $repo -> find($id) ;
            $sendDatabase= $this ->getDoctrine()->getManager();
            $sendDatabase->remove($crud);
            $sendDatabase->flush();
            $this->addFlash('notice', 'suppression réussi !!');

            return $this->redirectToRoute("app_main"); #redirection vers la page d'accueil

        }

        /*return $this->render('main/deleteForm.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
        ]);*/
    }
