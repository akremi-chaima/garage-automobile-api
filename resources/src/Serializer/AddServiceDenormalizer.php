<?php
namespace App\Serializer;

use App\DTO\AddServiceDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class AddServiceDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new AddServiceDTO())
            ->setName($data['name'] ?? null)
            ->setIsActive($data['isActive'] ?? false);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === AddServiceDTO::class;
    }
}