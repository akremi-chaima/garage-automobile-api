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
     * @ORM\Column(name="day", type="string", length=5, nullable=false)
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


}
