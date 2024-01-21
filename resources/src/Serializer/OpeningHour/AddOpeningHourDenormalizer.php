<?php
namespace App\Serializer\OpeningHour;

use App\DTO\OpeningHour\AddOpeningHourDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class AddOpeningHourDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new AddOpeningHourDTO())
            ->setDay($data['day'] ?? null)
            ->setMorningStartHour($data['morningStartHour'] ?? null)
            ->setMorningEndHour($data['morningEndHour'] ?? null)
            ->setAfternoonStartHour($data['afternoonStartHour'] ?? null)
            ->setAfternoonEndHour($data['afternoonEndHour'] ?? null);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === AddOpeningHourDTO::class;
    }
}