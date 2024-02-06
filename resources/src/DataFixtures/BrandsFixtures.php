<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands = ['ABARTH', 'AIWAYS', 'ALEKO', 'ALFA ROMEO', 'ALPINE RENAULT', 'ARO', 'ASIA', 'ASTON MARTIN', 'AUDI', 'AUSTIN', 'AUTOBIANCHI', 'AUVERLAND', 'BEDFORD', 'BENTLEY', 'BERTONE', 'BMW', 'BUICK', 'BYD', 'CADILLAC', 'CHEVROLET', 'CHRYSLER', 'CITROEN', 'COURB', 'CUPRA', 'DACIA', 'DAEWOO', 'DAF', 'DAIHATSU', 'DAIMLER', 'DATSUN', 'DODGE', 'DS', 'EBRO', 'FERRARI', 'FEST', 'FIAT', 'FISKER', 'FORD', 'FSO-POLSKI', 'GAC GONOW', 'GME', 'GRANDIN', 'HONDA', 'HYUNDAI', 'INEOS', 'INFINITI', 'INNOCENTI', 'ISUZU', 'IVECO', 'JAGUAR', 'JEEP', 'KIA', 'LADA', 'LAMBORGHINI', 'LANCIA', 'LAND ROVER', 'LDV', 'LEAPMOTOR', 'LEXUS', 'LOTUS', 'LYNK&amp;CO', 'MAHINDRA', 'MAN', 'MARUTI', 'MASERATI', 'MATRA', 'MAZDA', 'MCC', 'MEGA', 'MERCEDES', 'MG', 'MIA', 'MINI', 'MITSUBISHI', 'MPM MOTORS', 'NISSAN', 'OPEL', 'PANHARD', 'PEUGEOT', 'PIAGGIO', 'PONTIAC', 'PORSCHE', 'PROTON', 'RENAULT', 'ROVER', 'SAAB', 'SANTANA', 'SEAT', 'SERES DFSK', 'SKODA', 'SMART', 'SSANGYONG', 'SUBARU', 'SUNBEAM', 'SUZUKI', 'TALBOT', 'TATA', 'TESLA', 'THINK', 'TOYOTA', 'TRIUMPH', 'UMM', 'VINFAST', 'VOLKSWAGEN', 'VOLVO', 'ZASTAVA', 'ZAZ'];

        foreach ($brands as $brandName) {
            $brand = (new Brand())
                ->setName($brandName);
            $manager->persist($brand);
            $this->addReference($brandName, $brand);
        }

        $manager->flush();
    }
}
