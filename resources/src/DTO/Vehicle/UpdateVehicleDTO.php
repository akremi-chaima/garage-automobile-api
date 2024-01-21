<?php

namespace App\DTO\Vehicle;

/**
 * Class UpdateVehicleDTO
 */
class UpdateVehicleDTO extends AddVehicleDTO
{
    /**
     * @inheritdoc
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}