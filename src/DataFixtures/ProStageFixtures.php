<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProStageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $visiteur = new Visiteur();
        $visiteur->setFormation();
        $visiteur->setPorte();
        $visiteur->setAccompagnateur();
        $manager->persist($visiteur);

        $manager->flush();
    }
}
