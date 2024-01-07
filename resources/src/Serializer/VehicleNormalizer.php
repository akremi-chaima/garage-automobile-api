<?php
namespace App\Serializer;

use App\Entity\Vehicle;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class VehicleNormalizer implements NormalizerInterface
{
    /** @var ColorNormalizer */
    private $colorNormalizer;

    /** @var ModelNormalizer */
    private $modelNormalizer;

    /** @var EnergyNormalizer */
    private $energyNormalizer;

    /** @var GearboxNormalizer */
    private $gearboxNormalizer;

    /** @var OptionNormalizer */
    private $optionNormalizer;

    /**
     * @param ColorNormalizer $colorNormalizer
     * @param ModelNormalizer $modelNormalizer
     * @param EnergyNormalizer $energyNormalizer
     * @param GearboxNormalizer $gearboxNormalizer
     * @param OptionNormalizer $optionNormalizer
     */
    public function __construct(
        ColorNormalizer $colorNormalizer,
        ModelNormalizer $modelNormalizer,
        EnergyNormalizer $energyNormalizer,
        GearboxNormalizer $gearboxNormalizer,
        OptionNormalizer $optionNormalizer
    ) {
        $this->colorNormalizer = $colorNormalizer;
        $this->modelNormalizer = $modelNormalizer;
        $this->energyNormalizer = $energyNormalizer;
        $this->gearboxNormalizer = $gearboxNormalizer;
        $this->optionNormalizer = $optionNormalizer;
    }

    /**
     * @param Vehicle $vehicle
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($vehicle, string $format = null, array $context = [])
    {
        $options = [];
        foreach ($vehicle->getOptions() as $option) {
            $options[] = $this->optionNormalizer->normalize($option);
        }

        return [
           'id' => $vehicle->getId(),
           'circulationDate' => $vehicle->getCirculationDate()->format('d/m/Y'),
           'price' => $vehicle->getPrice(),
           'fiscalPower' => $vehicle->getFiscalPower(),
           'mileage' => $vehicle->getMileage(),
           'manufacturingYear' => $vehicle->getManufacturingYear(),
           'color' => $this->colorNormalizer->normalize($vehicle->getColor()),
           'energy' => $this->energyNormalizer->normalize($vehicle->getEnergy()),
           'gearbox' => $this->gearboxNormalizer->normalize($vehicle->getGearbox()),
           'model' => $this->modelNormalizer->normalize($vehicle->getModel()),
           'options' => $options,
        ];

    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Vehicle;
    }
}