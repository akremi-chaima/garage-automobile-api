<?php
namespace App\Serializer;

use App\DTO\ContactDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class FeedbackDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new ContactDTO())
            ->setEmail($data['email'] ?? null)
            ->setZipCode($data['zipCode'] ?? null)
            ->setCity($data['city'] ?? null)
            ->setFirstName($data['firstName'] ?? null)
            ->setLastName($data['lastName'] ?? null)
            ->setAddress($data['address'] ?? null)
            ->setSubject($data['subject'] ?? null)
            ->setMessage($data['message'] ?? null)
            ->setPhoneNumber($data['phoneNumber'] ?? null);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === ContactDTO::class;
    }
}