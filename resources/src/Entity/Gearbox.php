<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gearbox
 *
 * @ORM\Table(name="gearbox")
 * @ORM\Entity
 */
class Gearbox
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;


}
