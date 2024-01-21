<?php
namespace App\Serializer\Service;

use App\Entity\Service;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ServiceNormalizer implements NormalizerInterface
{
    /**
     * @param Service $service
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($service, string $format = null, array $context = [])
    {
       return [
           'id' => $service->getId(),
           'name' => $service->getName(),
           'isActive' => $service->isActive(),
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Service;
    }
}