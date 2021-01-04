<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Prestation;
use App\Entity\PrestationType;
use App\Entity\PrestationStatut;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\Purger\PurgerInterface;
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
        //Création des users
        for ($i = 0; $i < 50; $i++) {
            $_user[] = new User();
            $_user[$i]->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setAddress($faker->address)
                ->setCity($faker->city)
                ->setPostalCode($faker->numberBetween(10000, 98000))
                ->setPhone("0612211190")
                ->setPassword($this->encoder->encodePassword($_user[$i], 'password'))
                ->setCreatedAt(new \DateTime());
            if ($i == 0) {
                $_user[0]->setRoles(["ROLE_ADMIN"]);
                $_user[0]->setEmail("hacenesahraoui.paris@gmail.com");
            } else if ($i > 0) {
                $_user[$i]->setRoles(["ROLE_USER"])
                    ->setEmail("user$i@gmail.com");
            }
            $manager->persist($_user[$i]);
        }

        //creation des statuts
        for ($k = 0; $k < 3; $k++) {
            $_statut[] = new PrestationStatut();
            if ($k == 0)
                $_statut[$k]->setNom("en attente d'acceptation");
            else if ($k == 1)
                $_statut[$k]->setNom("en cours de réalisation");
            else if ($k == 2)
                $_statut[$k]->setNom("terminé");;
            $manager->persist($_statut[$k]);
        }

        //Création des types de prestation
        for ($j = 0; $j <= 4; $j++) {
            $_type[] = new PrestationType();
            if ($j == 0)
                $_type[$j]->setNom("ménage")
                    ->setTarif(10);
            elseif ($j == 1)
                $_type[$j]->setNom("course")
                    ->setTarif(8);
            elseif ($j == 2)
                $_type[$j]->setNom("cuisine")
                    ->setTarif(13);
            elseif ($j == 3)
                $_type[$j]->setNom("garde d'enfant")
                    ->setTarif(9);
            elseif ($j == 4)
                $_type[$j]->setNom("déménagement")
                    ->setTarif(16);
            $manager->persist($_type[$j]);
        }

        //création des prestations
        for ($l = 0; $l < 500; $l++) {
            $_prestation[] = new Prestation();
            $_prestation[$l]->setCreatedAt(new \DateTime())
                ->setNbheure($faker->numberBetween(1, 11))
                ->setUser($_user[rand(0, count($_user) - 1)])
                ->setStatut($_statut[rand(0, count($_statut) - 1)])
                ->setType($_type[rand(0, count($_type) - 1)]);
            $manager->persist($_prestation[$l]);
        }
        $manager->flush();
    }
}
