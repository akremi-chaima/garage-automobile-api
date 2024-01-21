<?php
namespace App\Serializer\Option;

use App\Entity\Options;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class OptionNormalizer implements NormalizerInterface
{
    /** @var OptionTypeNormalizer $optionTypeNormalizer */
    private $optionTypeNormalizer;

    /**
     * @param OptionTypeNormalizer $optionTypeNormalizer
     */
    public function __construct(OptionTypeNormalizer $optionTypeNormalizer)
    {
        $this->optionTypeNormalizer = $optionTypeNormalizer;
    }
    /**
     * @param Options $options
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($options, string $format = null, array $context = [])
    {
       return [
           'id' => $options->getId(),
           'name' => $options->getName(),
           'optionType' => $this->optionTypeNormalizer->normalize($options->getOptionType()),
       ];
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Options;
    }
}