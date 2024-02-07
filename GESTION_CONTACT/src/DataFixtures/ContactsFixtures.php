<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $contact = new Contact();
        $contact->setNom($faker->lastName())
                ->setPrenom($faker->firstName());
        $genres = ["male", "female"];
        $manager->flush();
    }
}
