<?php

namespace App\DTO\User;

/**
 * Class AddUserDTO
 */
class AddUserDTO extends UserDTO
{
    /**
     * @inheritdoc
     */
    private $password;

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}