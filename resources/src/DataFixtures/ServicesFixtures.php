<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $services = [
            'Dépannage',
            'Présentation au contrôle technique',
            'Station de lavage',
            'Pré-contrôle technique',
            'Démarche déclaration sinistre assurance',
            'Montages de pneus'
        ];

        foreach ($services as $serviceName) {
            $service = (new Service())
                ->setName($serviceName)
                ->setActive(true);
            $manager->persist($service);
        }

        $manager->flush();
    }
}
