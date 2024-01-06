<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Options
 *
 * @ORM\Table(name="options", indexes={@ORM\Index(name="fk_options_option_type1_idx", columns={"option_type_id"})})
 * @ORM\Entity
 */
class Options
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
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var OptionType
     *
     * @ORM\ManyToOne(targetEntity="OptionType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="option_type_id", referencedColumnName="id")
     * })
     */
    private $optionType;

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
     * @return Options
     */
    public function setName(string $name): Options
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return OptionType
     */
    public function getOptionType(): OptionType
    {
        return $this->optionType;
    }

    /**
     * @param OptionType $optionType
     * @return Options
     */
    public function setOptionType(OptionType $optionType): Options
    {
        $this->optionType = $optionType;
        return $this;
    }
}
