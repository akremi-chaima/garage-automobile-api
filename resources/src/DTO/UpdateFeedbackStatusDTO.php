<?php

namespace App\DTO;

/**
 * Class UpdateFeedbackStatusDTO
 */
class UpdateFeedbackStatusDTO
{
    /**
     * @inheritdoc
     */
    private $id;

    /**
     * @inheritdoc
     */
    private $statusCode;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return UpdateFeedbackStatusDTO
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return UpdateFeedbackStatusDTO
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}