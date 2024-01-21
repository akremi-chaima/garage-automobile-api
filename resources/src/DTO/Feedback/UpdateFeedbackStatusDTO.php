<?php

namespace App\DTO\Feedback;

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
     * @return self
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
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}