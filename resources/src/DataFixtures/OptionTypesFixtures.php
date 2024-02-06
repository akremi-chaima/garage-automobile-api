<?php

namespace App\DataFixtures;

use App\Entity\OptionType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OptionTypesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $optionTypes = [
            'Extérieur et Chassis',
            'Intérieur',
            'Sécurité',
            'Autre'
        ];

        foreach ($optionTypes as $optionTypeName) {
            $optionType = (new OptionType())
                ->setName($optionTypeName);
            $manager->persist($optionType);
        }

        $manager->flush();
    }
}
