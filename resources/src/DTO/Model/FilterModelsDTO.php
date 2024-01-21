<?php

namespace App\DTO\Model;

/**
 * Class FilterModelsDTO
 */
class FilterModelsDTO
{
    /**
     * @inheritdoc
     */
    protected $brandId;

    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @param mixed $brandId
     * @return self
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;
        return $this;
    }
}