<?php
namespace App\Serializer;

use App\DTO\UpdateVehicleDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UpdateVehicleDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new UpdateVehicleDTO())
            ->setId($data['id'] ?? null)
            ->setCirculationDate($data['circulationDate'] ?? null)
            ->setColorId($data['colorId'] ?? null)
            ->setEnergyId($data['energyId'] ?? null)
            ->setFiscalPower($data['fiscalPower'] ?? null)
            ->setGearboxId($data['gearboxId'] ?? null)
            ->setManufacturingYear($data['manufacturingYear'] ?? null)
            ->setMileage($data['mileage'] ?? null)
            ->setModelId($data['modelId'] ?? null)
            ->setOptionsIds($data['optionsIds'] ?? null)
            ->setPrice($data['price'] ? floatval($data['price']) : null)
            ->setIsActive($data['isActive'] ?? false);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === UpdateVehicleDTO::class;
    }
}