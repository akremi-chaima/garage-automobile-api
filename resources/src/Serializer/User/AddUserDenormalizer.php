<?php
namespace App\Serializer\User;

use App\DTO\User\AddUserDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class AddUserDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new AddUserDTO())
            ->setPassword($data['password'] ?? null)
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
        return $type === AddUserDTO::class;
    }
}