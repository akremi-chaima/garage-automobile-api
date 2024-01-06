<?php

namespace App\DTO;

/**
 * Class AddServiceDTO
 */
class AddServiceDTO
{
    /**
     * @inheritdoc
     */
    private $name;

    /**
     * @inheritdoc
     */
    private $isActive;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return AddServiceDTO
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return AddServiceDTO
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }
}