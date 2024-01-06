<?php
namespace App\Serializer;

use App\DTO\UpdateServiceDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UpdateServiceDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new UpdateServiceDTO())
            ->setId($data['id'] ?? null)
            ->setName($data['name'] ?? null)
            ->setIsActive($data['isActive'] ?? false);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === UpdateServiceDTO::class;
    }
}