<?php

namespace App\DTO\User;

/**
 * Class UpdateUserDTO
 */
class UpdateUserDTO extends UserDTO
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