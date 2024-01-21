<?php
namespace App\Serializer\Model;

use App\DTO\Model\FilterModelsDTO;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ModelDenormalizer implements DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return (new FilterModelsDTO())
            ->setBrandId($data['brandId'] ?? null);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === FilterModelsDTO::class;
    }
}