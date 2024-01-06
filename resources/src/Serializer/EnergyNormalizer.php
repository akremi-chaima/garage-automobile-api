<?php
namespace App\Serializer;

use App\Entity\Energy;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class EnergyNormalizer implements NormalizerInterface
{
    /**
     * @param Energy $energy
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($energy, string $format = null, array $context = [])
    {
       return [
           'id' => $energy->getId(),
           'name' => $energy->getName(),
        ];

    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Energy;
    }
}