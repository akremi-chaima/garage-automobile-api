<?php

namespace App\DTO;

/**
 * Class UpdateVehicleDTO
 */
class UpdateVehicleDTO
{
    /**
     * @inheritdoc
     */
    private $id;

    /**
     * @inheritdoc
     */
    private $price;

    /**
     * @inheritdoc
     */
    private $circulationDate;

    /**
     * @inheritdoc
     */
    private $mileage;

    /**
     * @inheritdoc
     */
    private $fiscalPower;

    /**
     * @inheritdoc
     */
    private $manufacturingYear;

    /**
     * @inheritdoc
     */
    private $isActive;

    /**
     * @inheritdoc
     */
    private $colorId;

    /**
     * @inheritdoc
     */
    private $energyId;

    /**
     * @inheritdoc
     */
    private $gearboxId;

    /**
     * @inheritdoc
     */
    private $modelId;

    /**
     * @inheritdoc
     */
    private $optionsIds;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return UpdateVehicleDTO
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
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
     * @return AddVehicleDTO
     */
    public function setOptionsIds($optionsIds)
    {
        $this->optionsIds = $optionsIds;
        return $this;
    }
}