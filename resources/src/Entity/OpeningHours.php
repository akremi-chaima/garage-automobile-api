<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OpeningHours
 *
 * @ORM\Table(name="opening_hours")
 * @ORM\Entity
 */
class OpeningHours
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="day", type="string", length=10, nullable=false)
     */
    private $day;

    /**
     * @var string|null
     *
     * @ORM\Column(name="morning_start_hour", type="string", length=5, nullable=true)
     */
    private $morningStartHour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="morning_end_hour", type="string", length=5, nullable=true)
     */
    private $morningEndHour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="afternoon_start_hour", type="string", length=5, nullable=true)
     */
    private $afternoonStartHour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="afternoon_end_hour", type="string", length=5, nullable=true)
     */
    private $afternoonEndHour;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @param string $day
     * @return OpeningHours
     */
    public function setDay(string $day): OpeningHours
    {
        $this->day = $day;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMorningStartHour(): ?string
    {
        return $this->morningStartHour;
    }

    /**
     * @param string|null $morningStartHour
     * @return OpeningHours
     */
    public function setMorningStartHour(?string $morningStartHour): OpeningHours
    {
        $this->morningStartHour = $morningStartHour;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMorningEndHour(): ?string
    {
        return $this->morningEndHour;
    }

    /**
     * @param string|null $morningEndHour
     * @return OpeningHours
     */
    public function setMorningEndHour(?string $morningEndHour): OpeningHours
    {
        $this->morningEndHour = $morningEndHour;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAfternoonStartHour(): ?string
    {
        return $this->afternoonStartHour;
    }

    /**
     * @param string|null $afternoonStartHour
     * @return OpeningHours
     */
    public function setAfternoonStartHour(?string $afternoonStartHour): OpeningHours
    {
        $this->afternoonStartHour = $afternoonStartHour;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAfternoonEndHour(): ?string
    {
        return $this->afternoonEndHour;
    }

    /**
     * @param string|null $afternoonEndHour
     * @return OpeningHours
     */
    public function setAfternoonEndHour(?string $afternoonEndHour): OpeningHours
    {
        $this->afternoonEndHour = $afternoonEndHour;
        return $this;
    }
}
