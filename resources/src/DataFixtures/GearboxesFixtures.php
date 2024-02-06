<?php

namespace App\DataFixtures;

use App\Entity\Gearbox;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GearboxesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $gearboxes = [
            'Boîte automatique',
            'Boîte manuelle',
        ];

        foreach ($gearboxes as $gearboxName) {
            $gearbox = (new Gearbox())
                ->setName($gearboxName);
            $manager->persist($gearbox);
            $this->addReference($gearboxName, $gearbox);
        }

        $manager->flush();
    }
}
