<?php

namespace App\DTO\Service;

/**
 * Class AddServiceDTO
 */
class AddServiceDTO
{
    /**
     * @inheritdoc
     */
    protected $name;

    /**
     * @inheritdoc
     */
    protected $isActive;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return self
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
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }
}