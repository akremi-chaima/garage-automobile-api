<?php

namespace App\DataFixtures;

use App\Entity\Options;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OptionsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $options = [
            'Extérieur et Chassis' => [
                'Aide parking',
                'Attelage',
                'Barres de toit',
                'Frein de parking automatique',
                'Jantes alu',
                'Jantes alu 18"',
                'Radar de recul',
                'Rétroviseurs électriques et dégivrants'
            ],
            'Intérieur' => [
                'Accoudoir central avant',
                'Boite 6 vitesses',
                'Carte main libre',
                'Climatisation automatique',
                'Climatisation automatique multi zone',
                'Direction assistée',
                'Fermeture électrique',
                'GPS',
                'Prise audio USB',
                'Prises audio auxiliaires',
                'Régulateur de vitesse',
                'Régulateur limiteur de vitesse',
                'Rétroviseur int. jour/nuit auto',
                'Sièges chauffants',
                'Système audio MP3',
                'Tapis de sol',
                'Vitres ar. surteintées',
                'Vitres électriques',
                'Volant cuir',
                'Volant réglable en hauteur et profondeur',
                'Écran tactile',
                'APPLE CAR PLAY',
                'Android Auto',
                'Bluetooth'
            ],
            'Sécurité' => [
                'ABS',
                'Aide au démarrage en côte',
                'Airbags frontaux',
                'Airbags latéraux',
                'Alerte franchissement ligne',
                'Projecteurs antibrouillard',
                'Contrôle de pression des pneus',
                'Détecteur de pluie',
                'ESP',
                'Feux automatiques',
                'Phares av. de jour à LED'
            ],
            'Autre' => [
                '5 Portes',
                '5 places',
                'Alerte Anti-Collision',
                'Alerte attention conducteur',
                'Cockpit numérique',
                'Compresseur',
                'Détecteur d\'Angles Morts',
                'Détecteur de Fatigue',
                'Fonction DAB',
                'Intérieur gris',
                'Jantes Bicolores',
                'MITISSUGRISNOIR',
                'Mirror Link',
                'Reconnaissance des panneaux',
                'Sièges tissus',
                'Système Start & Stop',
                'Camera 360',
                'Freinage actif d\'urgence',
                'Radar avant de détection d\'obstacles',
                'Volant réglable'
            ]
        ];

        foreach ($options as $optionTypeName => $optionNames) {
            foreach ($optionNames as $optionName) {
                $option = (new Options())
                    ->setName($optionName)
                    ->setOptionType($this->getReference($optionTypeName));
                $manager->persist($option);
                $this->addReference($optionName, $option);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OptionTypesFixtures::class,
        ];
    }
}
