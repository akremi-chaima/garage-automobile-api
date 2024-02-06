<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FeedbacksFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $feedbacks = [
            [
                'firstname' => 'Timothé',
                'lastname' => 'Béthuleau',
                'message' => 'Bon accueil, travail qualitatif remis en temps et en heure. Je recommande.',
                'stars' => 5
            ],
            [
                'firstname' => 'Jade',
                'lastname' => 'Lemaire',
                'message' => 'Garagiste très accueillant et sympa. Service très rapide et efficace. Je recommande.',
                'stars' => 4
            ],
            [
                'firstname' => 'Albane',
                'lastname' => 'Morel',
                'message' => 'Sérieux professionnel à l\'écoute',
                'stars' => 5
            ],
            [
                'firstname' => 'Julie',
                'lastname' => 'Perrin',
                'message' => 'Très bonne expérience dans ce garage, le personnel est accueillant et poli, le travail est de qualité et les prix sont raisonnables. Je recommande vivement.',
                'stars' => 5
            ],
        ];

        foreach ($feedbacks as $feedbackItem) {
            $feedback = (new Feedback())
                ->setLastname($feedbackItem['lastname'])
                ->setFirstname($feedbackItem['firstname'])
                ->setStars($feedbackItem['stars'])
                ->setMessage($feedbackItem['message'])
                ->setCreatedAt(new \DateTime())
                ->setStatus($this->getReference('visible'));
            $manager->persist($feedback);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StatusFixtures::class,
        ];
    }
}
