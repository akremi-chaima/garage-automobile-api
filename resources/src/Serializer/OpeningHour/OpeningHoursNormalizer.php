<?php
namespace App\Serializer\OpeningHour;

use App\Entity\OpeningHours;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class OpeningHoursNormalizer implements NormalizerInterface
{
    /**
     * @param OpeningHours $openingHours
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($openingHours, string $format = null, array $context = [])
    {
       return [
           'id' => $openingHours->getId(),
           'day' => $openingHours->getDay(),
           'morningStartHour' => $openingHours->getMorningStartHour(),
           'morningEndHour' => $openingHours->getMorningEndHour(),
           'afternoonStartHour' => $openingHours->getAfternoonStartHour(),
           'afternoonEndHour' => $openingHours->getAfternoonEndHour(),
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof OpeningHours;
    }
}