<?php
namespace App\Serializer;

use App\Entity\Model;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ModelNormalizer implements NormalizerInterface
{
    /** @var BrandNormalizer $brandNormalizer */
    private $brandNormalizer;

    /**
     * @param BrandNormalizer $brandNormalizer
     */
    public function __construct(BrandNormalizer $brandNormalizer)
    {
        $this->brandNormalizer = $brandNormalizer;
    }

    /**
     * @param Model $model
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($model, string $format = null, array $context = [])
    {
       return [
           'id' => $model->getId(),
           'name' => $model->getName(),
           'brand' => $this->brandNormalizer->normalize($model->getBrand())
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Model;
    }
}