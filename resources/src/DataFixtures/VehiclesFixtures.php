<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VehiclesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $vehicles = [
            ['price' => 15000, 'circulationDate' => new \DateTime('2023-10-15'), 'mileage' => 65000, 'fiscalPower' => 7, 'manufacturingYear' => 2023, 'color' => 'Rouge', 'energy' => 'Diesel', 'gearbox' => 'Boîte automatique', 'model' => 'A1'],
            ['price' => 10000, 'circulationDate' => new \DateTime('2022-12-01'), 'mileage' => 5000, 'fiscalPower' => 5, 'manufacturingYear' => 2022, 'color' => 'Blanc', 'energy' => 'Essence', 'gearbox' => 'Boîte manuelle', 'model' => 'X1'],
            ['price' => 30000, 'circulationDate' => new \DateTime('2023-09-09'), 'mileage' => 7000, 'fiscalPower' => 7, 'manufacturingYear' => 2023, 'color' => 'Blanc', 'energy' => 'Hybrides', 'gearbox' => 'Boîte automatique', 'model' => 'X3'],
            ['price' => 55000, 'circulationDate' => new \DateTime('2023-12-01'), 'mileage' => 2000, 'fiscalPower' => 9, 'manufacturingYear' => 2023, 'color' => 'Noir', 'energy' => 'Diesel', 'gearbox' => 'Boîte manuelle', 'model' => 'GLC'],
        ];

        $options = [
            'Aide parking',
            'Attelage',
            'Barres de toit',
            'Frein de parking automatique',
            'Jantes alu',
            'Jantes alu 18"',
            'Radar de recul',
            'Rétroviseurs électriques et dégivrants',
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
            'Bluetooth',
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
            'Phares av. de jour à LED',
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
        ];

        foreach ($vehicles as $vehicleDetails) {
            $vehicle = (new Vehicle())
                ->setPrice($vehicleDetails['price'])
                ->setCirculationDate($vehicleDetails['circulationDate'])
                ->setMileage($vehicleDetails['mileage'])
                ->setFiscalPower($vehicleDetails['fiscalPower'])
                ->setManufacturingYear($vehicleDetails['manufacturingYear'])
                ->setColor($this->getReference($vehicleDetails['color']))
                ->setEnergy($this->getReference($vehicleDetails['energy']))
                ->setGearbox($this->getReference($vehicleDetails['gearbox']))
                ->setModel($this->getReference($vehicleDetails['model']));
            $vehicleOptions = [];
            // Add options randomly
            for ($i = 0; $i < 10; $i++) {
                $vehicleOptions[] = $this->getReference($options[rand(0, count($options) - 1)]);
            }
            $vehicle->setOptions($vehicleOptions);
            $manager->persist($vehicle);
            $manager->flush();
            mkdir('./public/uploads/'.$vehicle->getId());
            for ($i = 1; $i < 4; $i++) {
                $picture = (new Picture())
                    ->setName($i . '.png')
                    ->setVehicle($vehicle);
                $manager->persist($picture);
                $manager->flush();
                mkdir('./public/uploads/'.$vehicle->getId().'/'.$picture->getId());
                copy('./public/images/'.strtolower($vehicleDetails['model']).'/'.$i . '.png', './public/uploads/'.$vehicle->getId().'/'.$picture->getId().'/'.$i . '.png');
            }
        }
    }

    public function getDependencies()
    {
        return [
            GearboxesFixtures::class,
            EnergiesFixtures::class,
            ModelsFixtures::class,
            ColorsFixtures::class,
            OptionsFixtures::class,
        ];
    }
}
