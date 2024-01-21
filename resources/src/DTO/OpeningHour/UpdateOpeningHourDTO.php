<?php

namespace App\DTO\OpeningHour;

/**
 * Class UpdateOpeningHourDTO
 */
class UpdateOpeningHourDTO extends AddOpeningHourDTO
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