<?php
namespace App\Serializer\Vehicle;

use App\DTO\Vehicle\VehiclesFilterDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class VehiclesFilterDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new VehiclesFilterDTO())
            ->setBrandId($data['brandId'] ?? null)
            ->setModelId($data['modelId'] ?? null)
            ->setMinPrice($data['minPrice'] ?? null)
            ->setMaxPrice($data['maxPrice'] ?? null)
            ->setMinMileage($data['minMileage'] ?? null)
            ->setMaxMileage($data['maxMileage'] ?? null)
            ->setMinManufacturingYear($data['minManufacturingYear'] ?? null)
            ->setMaxManufacturingYear($data['maxManufacturingYear'] ?? null)
            ->setFiscalPower($data['fiscalPower'] ?? null)
            ->setColorId($data['colorId'] ?? null)
            ->setEnergyId($data['energyId'] ?? null)
            ->setGearboxId($data['gearboxId'] ?? null)
            ->setOrderBy($data['orderBy'] ?? null);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === VehiclesFilterDTO::class;
    }
}