<?php
namespace App\Serializer;

use App\DTO\LoginDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class LoginDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new LoginDTO())
            ->setPassword($data['password'] ?? null)
            ->setEmail($data['email'] ?? null);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === LoginDTO::class;
    }
}