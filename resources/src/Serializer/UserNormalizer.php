<?php
namespace App\Serializer;

use App\Entity\User;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserNormalizer implements NormalizerInterface
{
    /**
     * @param User $user
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($user, string $format = null, array $context = [])
    {
       return [
           'id' => $user->getId(),
           'firstName' => $user->getFirstname(),
           'lastName' => $user->getLastname(),
           'role' => $user->getRoles()[0],
           'email' => $user->getUsername(),
           'isActive' => $user->isActive(),
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof User;
    }
}