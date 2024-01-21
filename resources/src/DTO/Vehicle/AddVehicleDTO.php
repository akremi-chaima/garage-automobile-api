<?php

namespace App\DTO\Vehicle;

/**
 * Class AddVehicleDTO
 */
class AddVehicleDTO
{
    /**
     * @inheritdoc
     */
    protected $price;

    /**
     * @inheritdoc
     */
    protected $circulationDate;

    /**
     * @inheritdoc
     */
    protected $mileage;

    /**
     * @inheritdoc
     */
    protected $fiscalPower;

    /**
     * @inheritdoc
     */
    protected $manufacturingYear;

    /**
     * @inheritdoc
     */
    protected $isActive;

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
    protected $modelId;

    /**
     * @inheritdoc
     */
    protected $optionsIds;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCirculationDate()
    {
        return $this->circulationDate;
    }

    /**
     * @param mixed $circulationDate
     * @return self
     */
    public function setCirculationDate($circulationDate)
    {
        $this->circulationDate = $circulationDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * @param mixed $mileage
     * @return self
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
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
     * @return self
     */
    public function setFiscalPower($fiscalPower)
    {
        $this->fiscalPower = $fiscalPower;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getManufacturingYear()
    {
        return $this->manufacturingYear;
    }

    /**
     * @param mixed $manufacturingYear
     * @return self
     */
    public function setManufacturingYear($manufacturingYear)
    {
        $this->manufacturingYear = $manufacturingYear;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
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
     * @return self
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
     * @return self
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
     * @return self
     */
    public function setGearboxId($gearboxId)
    {
        $this->gearboxId = $gearboxId;
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
     * @return self
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionsIds()
    {
        return $this->optionsIds;
    }

    /**
     * @param mixed $optionsIds
     * @return self
     */
    public function setOptionsIds($optionsIds)
    {
        $this->optionsIds = $optionsIds;
        return $this;
    }
}