<?php

namespace App\DataFixtures;

use App\Entity\Energy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EnergiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $energies = [
            'Diesel',
            'Essence',
            'Hybrides',
            'Électrique'
        ];

        foreach ($energies as $energyName) {
            $energy = (new Energy())
                ->setName($energyName);
            $manager->persist($energy);
        }

        $manager->flush();
    }
}
