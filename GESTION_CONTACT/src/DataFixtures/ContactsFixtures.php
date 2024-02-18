<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $faker = Factory::create("fr_FR");
        $categories = [];  //tableau pour ranger les catégorie et les rappeler plus facilement ultérieurement

        $categorie = new categorie();
        $categorie -> setLibelle("Professionnel")
                    -> setDescription($faker->sentence(50))
                    -> setImage("https://picsum.photos/id/5/200/300");
        $manager->persist($categorie);
        $categories[]=$categorie;

        $categorie = new categorie();
        $categorie -> setLibelle("Sport")
                    -> setDescription($faker->sentence(50))
                    -> setImage("https://picsum.photos/id/73/200/300");
        $manager->persist($categorie);
        $categories[]=$categorie;

        $categorie = new categorie();
        $categorie -> setLibelle("Privé")
                    -> setDescription($faker->sentence(50))
                    -> setImage("https://picsum.photos/id/342/200/300");
        $manager->persist($categorie);
        $categories[]=$categorie;  
        
        $genres = ["male","female"];
        for ($i=0 ; $i<100 ;$i++){ //boucle qui permet de générer 100 contacts, on integre le sexe parce qu'on a une condition qui doit être prise en compte autrement on aurait aléatoirement soit un homme soit une femme 
        $sexe = mt_rand(0,1);  // 50/50 pour le genre
        {{ $sexe == 0 ? $type = 'men' : $type ='women';}}
        $contact = new Contact();
        $contact->setNom($faker->lastName())
                ->setPrenom($faker->firstName($genres[$sexe]))
                ->setRue($faker->streetAddress())
                ->setCp($faker->numberBetween(01000,97000))
                ->setVille($faker->city())
                ->setMail($faker->email())
                ->setSexe($sexe)
                ->setCategorie($categories[mt_rand(0,2)])
                ->setAvatar("https://randomuser.me/api/portraits/". $type."/".$i.".jpg"); //$i renvoit à la boucle plus haut qui génére les 100 contacts
        $manager->persist($contact); //on lui  dit que l'objet est en attente de coté avant qu'on lui donne l'ordre d'enregistrer dans la BDD
        }

        $manager->flush(); // Pour enregistrer nos données (qui sont en persist) dans la BDD.
    }
}