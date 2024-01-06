<?php

namespace App\DTO;

/**
 * Class UpdateOpeningHourDTO
 */
class UpdateOpeningHourDTO
{
    /**
     * @inheritdoc
     */
    private $id;

    /**
     * @inheritdoc
     */
    private $day;

    /**
     * @inheritdoc
     */
    private $morningStartHour;

    /**
     * @inheritdoc
     */
    private $morningEndHour;

    /**
     * @inheritdoc
     */
    private $afternoonStartHour;

    /**
     * @inheritdoc
     */
    private $afternoonEndHour;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return UpdateOpeningHourDTO
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     * @return AddOpeningHourDTO
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
     * @return AddOpeningHourDTO
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
     * @return AddOpeningHourDTO
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
     * @return AddOpeningHourDTO
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
     * @return AddOpeningHourDTO
     */
    public function setAfternoonEndHour($afternoonEndHour)
    {
        $this->afternoonEndHour = $afternoonEndHour;
        return $this;
    }
}