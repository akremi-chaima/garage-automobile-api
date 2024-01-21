<?php
namespace App\Serializer\Feedback;

use App\Entity\Feedback;
use App\Serializer\Status\StatusNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FeedbackNormalizer implements NormalizerInterface
{
    /** @var StatusNormalizer */
    private $statusNormalizer;

    /**
     * @param StatusNormalizer $statusNormalizer
     */
    public function __construct(StatusNormalizer $statusNormalizer)
    {
        $this->statusNormalizer = $statusNormalizer;
    }

    /**
     * @param Feedback $feedback
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($feedback, string $format = null, array $context = [])
    {
       return [
           'id' => $feedback->getId(),
           'stars' => $feedback->getStars(),
           'message' => $feedback->getMessage(),
           'firstName' => $feedback->getFirstname(),
           'lastName' => $feedback->getLastname(),
           'status' => $this->statusNormalizer->normalize($feedback->getStatus()),
           'createdAt' => $feedback->getCreatedAt()->format('d/m/Y'),
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Feedback;
    }
}