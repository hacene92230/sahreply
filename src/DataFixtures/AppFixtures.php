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
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
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
            } else if ($i > 0) {
                $user->setRoles(["ROLE_USER"]);
                $user->setEmail("user$i@gmail.com");
            }
            $manager->persist($user);

            //creation des statuts
            for ($k = 0; $k < 3; $k++) {
                $statut = new PrestationStatut();
                if ($k == 0)
                    $statut->setNom("en attente d'acceptation");
                else if ($k == 1)
                    $statut->setNom("en cours de réalisation");
                else if ($k == 2)
                    $statut->setNom("terminé");;
                $manager->persist($statut);

                //Création des types de prestation
                for ($j = 0; $j <= 4; $j++) {
                    $type = new PrestationType();
                    if ($j == 0)
                        $type->setNom("ménage")
                            ->setTarif(10);
                    elseif ($j == 1)
                        $type->setNom("course")
                            ->setTarif(8);
                    elseif ($j == 2)
                        $type->setNom("cuisine")
                            ->setTarif(13);
                    elseif ($j == 3)
                        $type->setNom("garde d'enfant")
                            ->setTarif(9);
                    elseif ($j == 4)
                        $type->setNom("déménagement")
                            ->setTarif(16);
                    $manager->persist($type);

                    //création des prestations
                    for ($l = 0; $l < 70; $l++) {
                        $prestation = new Prestation();
                        $prestation->setCreatedAt(new \DateTime())
                            ->setNbheure($faker->numberBetween(1, 11))
                            ->setUser($user)
                            ->setStatut($statut)
                            ->setType($type);
                        $manager->persist($prestation);
                    }
                }
            }
        }
        $manager->flush();
    }
}
