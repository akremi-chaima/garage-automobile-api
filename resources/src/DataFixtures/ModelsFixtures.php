<?php

namespace App\DataFixtures;

use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModelsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $models = [
            'AUDI' => [
                'A1', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'E-tron', 'Q3', 'Q5', 'Q7', 'Q7 Quattro', 'Q7 Quattro TDI', 'Q8', 'R8'
            ],
            'BMW' => [
               'I3', 'I4', 'I5', 'I7', 'I8', 'IX', 'Serie 1', 'Serie 2', 'Serie 3', 'Serie 4', 'Serie 5', 'Serie 6', 'Serie 7', 'Serie 8', 'X1', 'X2', 'X3', 'X4', 'X5', 'X6', 'X7'
            ],
            'CITROEN' => [
               'C2', 'C3', 'C4', 'C5', 'Picasso', 'Saxo'
            ],
            'CUPRA' => [
                'Formentor', 'CUPRA Leon', 'CUPRA Ateca', 'Born'
            ],
            'DACIA' => [
                'Duster', 'Sandero', 'Dokker', 'Logan', 'Lodgy'
            ],
            'DS' => [
                'DS3', 'DS3 crossback', 'DS4', 'DS4 crossback', 'DS5', 'DS7', 'DS9'
            ],
            'FORD' => [
                'Mustang', 'Focus', 'Fiesta', 'Kuga', 'Ranger', 'Puma'
            ],
            'INFINITI' => [
                'Q30', 'Q50', 'Q60', 'Q70', 'Qx30', 'Qx50', 'Qx60', 'Qx70'
            ],
            'JAGUAR' => [
                'F-Type', 'F-pace', 'E-pace'
            ],
            'JEEP' => [
                'Avenger', 'Wrangler' , 'Renegade', 'Compass', 'Willys'
            ],
            'KIA' => [
                'Sportage', 'Rio', 'Picanto', 'Niro', 'Stonic', 'Xceed'
            ],
            'LEXUS' => [
                'Rx', 'Nx', 'Ct', 'Is', 'Ux'
            ],
            'MAZDA' => [
                'Cx-3', 'Cx-5', 'Cx-30', 'Cx-60'
            ],
            'MERCEDES' => [
                'Class A', 'Class B', 'Class C', 'Class E', 'CLA', 'GLE', 'GLC', 'GLS'
            ],
            'MG' => [
                'A', 'B', 'C', 'MG EHS'
            ],
            'MINI' => [
                'Countryman', 'Mini cabriolet', 'Mini clubman', 'Paceman'
            ],
            'NISSAN' => [
                'Qashqai', 'Juke', 'X-trail', 'Micra', 'Navara'
            ],
            'OPEL' => [
                'Corsa', 'Astra', 'Mokka', 'Insignia', 'Grandland x'
            ],
            'PEUGEOT' => [
                '208', '308', '3008', '2008', '508', '5008', 'Partner', '404', '405', '406', '407'
            ],
            'RENAULT' => [
                'Clio', 'Megane', 'Captur', 'Twingo', 'Scenic', 'Express', 'Kadjar', 'Laguna'
            ],
            'ROVER' => [
                'Mini', '25', '75', 'Serie 100', 'Serie 400', 'Serie 600', 'Serie 800'
            ],
            'SEAT' => [
                'SEAT Leon', 'biza', 'SEAT Ateca', 'Arona', 'Tarraco', 'Alhambra'
            ],
            'SKODA' => [
                'Octavia', 'Fabia', 'Kodiaq', 'Karoq', 'Superb', 'Kamiq'
            ],
            'SMART' => [
                'Fortwo', 'Forfour', 'Roadster', 'Crossblade'
            ],
            'TESLA' => [
                'Model 3', 'Model s', 'Model x', 'Model y'
            ],
            'TOYOTA' => [
                'Yaris', 'Rav 4', 'C-HR', 'Auris', 'Land cruiser', 'Hilux'
            ],
            'VOLKSWAGEN' => [
                'Golf', 'Polo', 'Tiguan', 'T-roc', 'Touran', 'Passat'
            ],
            'VOLVO' => [
                'Xc60', 'Xc90', 'Xc40', 'V40', 'V60', 'S60'
            ]
        ];

        foreach ($models as $brandName => $modelsName) {
            foreach ($modelsName as $modelName) {
                $model = (new Model())
                    ->setName($modelName)
                    ->setBrand($this->getReference($brandName));
                $manager->persist($model);
                $this->addReference($modelName, $model);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BrandsFixtures::class,
        ];
    }
}
