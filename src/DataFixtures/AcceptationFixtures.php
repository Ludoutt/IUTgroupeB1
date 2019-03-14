<?php

namespace App\DataFixtures;

use App\Entity\Acceptation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AcceptationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        for($i=1; $i<=5; $i++){
            $acceptation = new Acceptation();
            $acceptation->setName('Acceptation '.$i);
            $acceptation->setDescription('Description de l\'acception '.$i);
            $manager->persist($acceptation);
        }

        $manager->flush();
    }
}
