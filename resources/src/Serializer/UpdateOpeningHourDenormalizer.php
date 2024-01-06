<?php
namespace App\Serializer;

use App\DTO\UpdateOpeningHourDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UpdateOpeningHourDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new UpdateOpeningHourDTO())
            ->setId($data['id'] ?? null)
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
        return $type === UpdateOpeningHourDTO::class;
    }
}