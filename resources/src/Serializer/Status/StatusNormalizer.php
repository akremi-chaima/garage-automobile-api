<?php
namespace App\Serializer\Status;

use App\Entity\Status;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class StatusNormalizer implements NormalizerInterface
{
    /**
     * @param Status $status
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($status, string $format = null, array $context = [])
    {
       return [
           'id' => $status->getId(),
           'name' => $status->getName(),
           'code' => $status->getCode(),
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Status;
    }
}