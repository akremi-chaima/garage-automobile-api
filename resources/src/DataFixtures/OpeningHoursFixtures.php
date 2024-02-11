<?php

namespace App\DataFixtures;

use App\Entity\OpeningHours;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OpeningHoursFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $days = [
            'Lundi',
            'Mardi',
            'Mercredi',
            'Jeudi',
            'Vendredi',
            'Samedi',
            'Dimanche'
        ];
        $morningStartHour = '08:45';
        $morningEndHour = '12:00';
        $afternoonStartHour = '14:00';
        $afternoonEndHour = '18:00';

        foreach ($days as $day) {
            $openingHour = (new OpeningHours())
                ->setDay($day);

            if (!in_array($day, ['Samedi', 'Dimanche'])) {
                $openingHour->setMorningStartHour($morningStartHour)
                    ->setMorningEndHour($morningEndHour)
                    ->setAfternoonStartHour($afternoonStartHour)
                    ->setAfternoonEndHour($afternoonEndHour);
            } else if ($day == 'Samedi') {
                $openingHour->setMorningStartHour($morningStartHour)
                    ->setMorningEndHour($morningEndHour)
                    ->setAfternoonStartHour(null)
                    ->setAfternoonEndHour(null);
            } if ($day == 'Dimanche') {
                $openingHour->setMorningStartHour(null)
                    ->setMorningEndHour(null)
                    ->setAfternoonStartHour(null)
                    ->setAfternoonEndHour(null);
            }

            $manager->persist($openingHour);
        }

        $manager->flush();
    }
}
