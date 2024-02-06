<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $feedbacksStatus = [
            ['name' => 'Non traité', 'code' => 'untreated'],
            ['name' => 'Visible', 'code' => 'visible'],
            ['name' => 'Invisible', 'code' => 'hidden'],
        ];

        foreach ($feedbacksStatus as $feedbackStatus) {
            $status = (new Status())
                ->setName($feedbackStatus['name'])
                ->setCode($feedbackStatus['code']);
            $manager->persist($status);
            $this->addReference($feedbackStatus['code'], $status);
        }

        $manager->flush();
    }
}
