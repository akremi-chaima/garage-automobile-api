<?php

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ColorsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $colors = [
            ['name' => 'Blanc', 'hexa_code' => '#FFFFFF'],
            ['name' => 'Gris', 'hexa_code' => '#808080'],
            ['name' => 'Noir', 'hexa_code' => '#000000'],
            ['name' => 'Rouge', 'hexa_code' => '#FF0000'],
            ['name' => 'Jaune', 'hexa_code' => '#FFFF00'],
            ['name' => 'Vert', 'hexa_code' => '#008000'],
            ['name' => 'Bleu', 'hexa_code' => '#0000FF'],
            ['name' => 'Marron', 'hexa_code' => '#800000'],
        ];

        foreach ($colors as $item) {
            $color = (new Color())
                ->setName($item['name'])
                ->setHexaCode($item['hexa_code']);
            $manager->persist($color);
            $this->addReference($item['name'], $color);
        }

        $manager->flush();
    }
}
