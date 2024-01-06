<?php
namespace App\Serializer;

use App\Entity\Color;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ColorNormalizer implements NormalizerInterface
{
    /**
     * @param Color $color
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($color, string $format = null, array $context = [])
    {
       return [
           'id' => $color->getId(),
           'name' => $color->getName(),
           'hexaCode' => $color->getHexaCode(),
        ];

    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Color;
    }
}