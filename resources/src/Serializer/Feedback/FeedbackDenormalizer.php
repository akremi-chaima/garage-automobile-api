<?php
namespace App\Serializer\Feedback;

use App\DTO\Feedback\AddFeedbackDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class FeedbackDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new AddFeedbackDTO())
            ->setStars($data['stars'] ?? null)
            ->setMessage($data['message'] ?? null)
            ->setFirstName($data['firstName'] ?? null)
            ->setLastName($data['lastName'] ?? null);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === AddFeedbackDTO::class;
    }
}