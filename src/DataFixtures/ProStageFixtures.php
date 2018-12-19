<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProStageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //création générateur de données faker
        $faker = \Faker\Factory::create('fr_FR'); // create a French faker

        for($i=0;$i<6;$i++){
        $entreprise = new Entreprise();
        $entreprise->setNom($faker->company);
        $entreprise->setAdresse($faker->address);
        $entreprise->setActivite($faker->catchPhrase);
        $entreprise->setSite($faker->domainName);
        $manager->persist($entreprise);
        
        $formation = new Formation();
        $formation->setLibelle($faker->jobTitle);
        $manager->persist($formation);

        $stage = new Stage();
        $stage->setTitre($faker->jobTitle);
        $stage->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2) );
        $stage->setMail($faker->companyEmail);
        $stage->setTelephone($faker->phoneNumber);
        $stage->setNomContact($faker->name($gender = null));
        $stage->setEntreprise($entreprise);
        $stage->addFormation($formation);
        $manager->persist($stage);
        }
        $manager->flush();
    }
}
