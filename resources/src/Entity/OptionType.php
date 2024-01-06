<?php
namespace App\Entity;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return OptionType
     */
    public function setName(string $name): OptionType
    {
        $this->name = $name;
        return $this;
    }
}
