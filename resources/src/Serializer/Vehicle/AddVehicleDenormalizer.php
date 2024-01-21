<?php
namespace App\Serializer\Vehicle;

use App\DTO\Vehicle\AddVehicleDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class AddVehicleDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new AddVehicleDTO())
            ->setCirculationDate($data['circulationDate'] ?? null)
            ->setColorId($data['colorId'] ? intval($data['colorId']) : null)
            ->setEnergyId($data['energyId'] ? intval($data['energyId']) : null)
            ->setFiscalPower($data['fiscalPower'] ? intval($data['fiscalPower']) : null)
            ->setGearboxId($data['gearboxId'] ? intval($data['gearboxId']) : null)
            ->setManufacturingYear($data['manufacturingYear'] ? intval($data['manufacturingYear']) : null)
            ->setMileage($data['mileage'] ? intval($data['mileage']) : null)
            ->setModelId($data['modelId'] ? intval($data['modelId']) : null)
            ->setOptionsIds($data['optionsIds'] ?? null)
            ->setPrice($data['price'] ? floatval($data['price']) : null)
            ->setIsActive($data['isActive'] ?? false);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === AddVehicleDTO::class;
    }
}