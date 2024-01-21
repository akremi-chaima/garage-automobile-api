<?php

namespace App\DTO\OpeningHour;

/**
 * Class AddOpeningHourDTO
 */
class AddOpeningHourDTO
{
    /**
     * @inheritdoc
     */
    protected $day;

    /**
     * @inheritdoc
     */
    protected $morningStartHour;

    /**
     * @inheritdoc
     */
    protected $morningEndHour;

    /**
     * @inheritdoc
     */
    protected $afternoonStartHour;

    /**
     * @inheritdoc
     */
    protected $afternoonEndHour;

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     * @return self
     */
    public function setDay($day)
    {
        $this->day = $day;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMorningStartHour()
    {
        return $this->morningStartHour;
    }

    /**
     * @param mixed $morningStartHour
     * @return self
     */
    public function setMorningStartHour($morningStartHour)
    {
        $this->morningStartHour = $morningStartHour;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMorningEndHour()
    {
        return $this->morningEndHour;
    }

    /**
     * @param mixed $morningEndHour
     * @return self
     */
    public function setMorningEndHour($morningEndHour)
    {
        $this->morningEndHour = $morningEndHour;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAfternoonStartHour()
    {
        return $this->afternoonStartHour;
    }

    /**
     * @param mixed $afternoonStartHour
     * @return self
     */
    public function setAfternoonStartHour($afternoonStartHour)
    {
        $this->afternoonStartHour = $afternoonStartHour;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAfternoonEndHour()
    {
        return $this->afternoonEndHour;
    }

    /**
     * @param mixed $afternoonEndHour
     * @return self
     */
    public function setAfternoonEndHour($afternoonEndHour)
    {
        $this->afternoonEndHour = $afternoonEndHour;
        return $this;
    }
}