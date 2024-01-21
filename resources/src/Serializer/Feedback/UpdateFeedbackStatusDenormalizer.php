<?php
namespace App\Serializer\Feedback;

use App\DTO\Feedback\UpdateFeedbackStatusDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UpdateFeedbackStatusDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new UpdateFeedbackStatusDTO())
            ->setId($data['email'] ?? null)
            ->setStatusCode($data['statusCode'] ?? null);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === UpdateFeedbackStatusDTO::class;
    }
}