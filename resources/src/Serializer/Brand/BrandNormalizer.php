<?php
namespace App\Serializer\Brand;

use App\Entity\Brand;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BrandNormalizer implements NormalizerInterface
{
    /**
     * @param Brand $brand
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($brand, string $format = null, array $context = [])
    {
       return [
           'id' => $brand->getId(),
           'name' => $brand->getName(),
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Brand;
    }
}