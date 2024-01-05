<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * OptionType
 *
 * @ORM\Table(name="option_type")
 * @ORM\Entity
 */
class OptionType
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
