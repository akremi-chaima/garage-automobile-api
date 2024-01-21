<?php
namespace App\Serializer\Option;

use App\Entity\OptionType;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class OptionTypeNormalizer implements NormalizerInterface
{
    /**
     * @param OptionType $optionType
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($optionType, string $format = null, array $context = [])
    {
       return [
           'id' => $optionType->getId(),
           'name' => $optionType->getName(),
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof OptionType;
    }
}