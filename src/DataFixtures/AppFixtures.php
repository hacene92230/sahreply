<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\PrestationType;
use App\Entity\PrestationStatut;
use App\Entity\Prestation;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("FR-fr");
        //creation des statuts possible
        for ($i = 0; $i < 3; $i++) {
            $statut = new PrestationStatut();
            if ($i == 0)
                $statut->setNom("en attente d'acceptation");
            else if ($i == 1)
                $statut->setNom("en cours de réalisation");
            else if ($i == 2)
                $statut->setNom("terminé");
            $manager->persist($statut);
        }

        //Création des types de prestation
        for ($i = 0; $i <= 4; $i++) {
            $type = new PrestationType();
            if ($i == 0)
                $type->setNom("ménage")
                    ->setTarif(10);
            elseif ($i == 1)
                $type->setNom("course")
                    ->setTarif(8);
            else if ($i == 2)
                $type->setNom("cuisine")
                    ->setTarif(13);
            else if ($i == 3)
                $type->setNom("garde d'enfant")
                    ->setTarif(9);
            else if ($i == 4)
                $type->setNom("déménagement")
                    ->setTarif(16);
            $manager->persist($type);
        }

        //création des prestations
        for ($i = 0; $i < 300; $i++) {
            $prestation = new \App\Entity\Prestation();
            $prestation->setCreatedAt(new \DateTime())
                ->setNbheure($faker->numberBetween(1, 11))
                ->addStatut(new PrestationStatut())
                ->addType(new PrestationType());
            $manager->persist($statut);
        }

        //Création des users
        for ($i = 0; $i < 30; $i++) {
            $user = new \App\Entity\User();
            $user->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setAddress($faker->address)
                ->setCity($faker->city)
                ->setPostalCode($faker->numberBetween(10000, 98000))
                ->setPhone("0612211190")
                ->setPassword($this->encoder->encodePassword($user, 'password'))
                ->setCreatedAt(new \DateTime());
            if ($i == 0) {
                $user->setRoles(["ROLE_ADMIN"]);
                $user->setEmail("hacenesahraoui.paris@gmail.com");
            } else {
                $user->setRoles(["ROLE_USER"]);
                $user->setEmail("user$i@gmail.com");
            }
            $manager->persist($user);
        }

        $manager->flush();
    }
}
