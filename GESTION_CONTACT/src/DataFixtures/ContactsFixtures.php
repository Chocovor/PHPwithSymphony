<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
/*use App\Entity\Categorie;*/
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        $categorie= new Categorie();
        $categorie  ->setLibelle("Professionnel")
                    ->setDescription($faker->sentence(50))
                    ->setImage("http:>//lorempixel.com/400/200/business");
        $manager->persist($categorie);
        $categorie  ->setLibelle("Sport")
                    ->setDescription($faker->sentence(50))
                    ->setImage("http:>//lorempixel.com/400/200/sports");
        $categorie  ->setLibelle("Privé")
                    ->setDescription($faker->sentence(50))
                    ->setImage("http:>//lorempixel.com/id/342/200/300");
        $manager->persist($categorie);       
        $manager->persist($categorie);
        $genres = ["male", "female"];
        for ($i=0; $i<100; $i++){
            $sexe = mt_rand(0,1);
            {{$sexe==0? $type='men' : $type='women';}}
        
        // Création de l'objet contact en utilisant le faux nom et prénom fourni par Faker.
        $contact = new Contact();
        $contact->setNom($faker->lastName())
                ->setPrenom($faker->firstName($genres[$sexe]))
                ->setRue($faker->streetAddress())
                ->setCp($faker->numberBetween (33000, 98765))
                ->setVille($faker->city())
                ->setMail($faker->email())
                ->setSexe($sexe)
                ->setAvatar("https://randomuser.me/api/portraits/".$type."/".$i."1.jpg");
        $manager->persist($contact);      
    }
    $manager->flush();
    }
}
