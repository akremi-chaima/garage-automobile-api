<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * Energy
 *
 * @ORM\Table(name="energy")
 * @ORM\Entity
 */
class Energy
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
