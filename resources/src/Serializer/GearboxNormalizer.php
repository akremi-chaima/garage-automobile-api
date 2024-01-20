<?php
namespace App\Serializer;

use App\Entity\Gearbox;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GearboxNormalizer implements NormalizerInterface
{
    /**
     * @param Gearbox $gearbox
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($gearbox, string $format = null, array $context = [])
    {
       return [
           'id' => $gearbox->getId(),
           'name' => $gearbox->getName(),
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Gearbox;
    }
}