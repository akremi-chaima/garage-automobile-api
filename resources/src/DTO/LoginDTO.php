<?php

namespace App\DTO;

/**
 * Class LoginDTO
 */
class LoginDTO
{
    /**
     * @inheritdoc
     */
    private $email;

    /**
     * @inheritdoc
     */
    private $password;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return AddUserDTO
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return AddUserDTO
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}