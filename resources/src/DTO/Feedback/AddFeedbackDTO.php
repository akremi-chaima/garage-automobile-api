<?php

namespace App\DTO\Feedback;

/**
 * Class AddFeedbackDTO
 */
class AddFeedbackDTO
{
    /**
     * @inheritdoc
     */
    private $stars;

    /**
     * @inheritdoc
     */
    private $lastName;

    /**
     * @inheritdoc
     */
    private $firstName;

    /**
     * @inheritdoc
     */
    private $message;

    /**
     * @return mixed
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @param mixed $stars
     * @return self
     */
    public function setStars($stars)
    {
        $this->stars = $stars;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}