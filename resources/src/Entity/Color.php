<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Color
 *
 * @ORM\Table(name="color")
 * @ORM\Entity
 */
class Color
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
     * @var string
     *
     * @ORM\Column(name="hexa_code", type="string", length=16, nullable=false)
     */
    private $hexaCode;

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
     * @return Color
     */
    public function setName(string $name): Color
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getHexaCode(): string
    {
        return $this->hexaCode;
    }

    /**
     * @param string $hexaCode
     * @return Color
     */
    public function setHexaCode(string $hexaCode): Color
    {
        $this->hexaCode = $hexaCode;
        return $this;
    }
}
