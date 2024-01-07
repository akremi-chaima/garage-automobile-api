<?php
namespace App\Serializer;

use App\DTO\UpdateUserDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UpdateUserDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new UpdateUserDTO())
            ->setId($data['id'] ?? null)
            ->setLastname($data['lastname'] ?? null)
            ->setFirstname($data['firstname'] ?? null)
            ->setEmail($data['email'] ?? null)
            ->setRole($data['role'] ?? null)
            ->setIsActive($data['isActive'] ?? false);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === UpdateUserDTO::class;
    }
}