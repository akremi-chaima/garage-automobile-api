<?php

namespace App\DTO\Vehicle;

/**
 * Class VehiclesFilterDTO
 */
class VehiclesFilterDTO
{
    /**
     * @inheritdoc
     */
    protected $brandId;

    /**
     * @inheritdoc
     */
    protected $modelId;

    /**
     * @inheritdoc
     */
    protected $minPrice;

    /**
     * @inheritdoc
     */
    protected $maxPrice;

    /**
     * @inheritdoc
     */
    protected $minMileage;

    /**
     * @inheritdoc
     */
    protected $maxMileage;

    /**
     * @inheritdoc
     */
    protected $minManufacturingYear;

    /**
     * @inheritdoc
     */
    protected $maxManufacturingYear;

    /**
     * @inheritdoc
     */
    protected $fiscalPower;

    /**
     * @inheritdoc
     */
    protected $colorId;

    /**
     * @inheritdoc
     */
    protected $energyId;

    /**
     * @inheritdoc
     */
    protected $gearboxId;

    /**
     * @inheritdoc
     */
    protected $orderBy;

    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @param mixed $brandId
     * @return VehiclesFilterDTO
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @param mixed $modelId
     * @return VehiclesFilterDTO
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * @param mixed $minPrice
     * @return VehiclesFilterDTO
     */
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param mixed $maxPrice
     * @return VehiclesFilterDTO
     */
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinMileage()
    {
        return $this->minMileage;
    }

    /**
     * @param mixed $minMileage
     * @return VehiclesFilterDTO
     */
    public function setMinMileage($minMileage)
    {
        $this->minMileage = $minMileage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxMileage()
    {
        return $this->maxMileage;
    }

    /**
     * @param mixed $maxMileage
     * @return VehiclesFilterDTO
     */
    public function setMaxMileage($maxMileage)
    {
        $this->maxMileage = $maxMileage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinManufacturingYear()
    {
        return $this->minManufacturingYear;
    }

    /**
     * @param mixed $minManufacturingYear
     * @return VehiclesFilterDTO
     */
    public function setMinManufacturingYear($minManufacturingYear)
    {
        $this->minManufacturingYear = $minManufacturingYear;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxManufacturingYear()
    {
        return $this->maxManufacturingYear;
    }

    /**
     * @param mixed $maxManufacturingYear
     * @return VehiclesFilterDTO
     */
    public function setMaxManufacturingYear($maxManufacturingYear)
    {
        $this->maxManufacturingYear = $maxManufacturingYear;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFiscalPower()
    {
        return $this->fiscalPower;
    }

    /**
     * @param mixed $fiscalPower
     * @return VehiclesFilterDTO
     */
    public function setFiscalPower($fiscalPower)
    {
        $this->fiscalPower = $fiscalPower;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColorId()
    {
        return $this->colorId;
    }

    /**
     * @param mixed $colorId
     * @return VehiclesFilterDTO
     */
    public function setColorId($colorId)
    {
        $this->colorId = $colorId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnergyId()
    {
        return $this->energyId;
    }

    /**
     * @param mixed $energyId
     * @return VehiclesFilterDTO
     */
    public function setEnergyId($energyId)
    {
        $this->energyId = $energyId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGearboxId()
    {
        return $this->gearboxId;
    }

    /**
     * @param mixed $gearboxId
     * @return VehiclesFilterDTO
     */
    public function setGearboxId($gearboxId)
    {
        $this->gearboxId = $gearboxId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     * @return VehiclesFilterDTO
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }
}