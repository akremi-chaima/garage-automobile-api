<?php
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
     * @var \OptionType
     *
     * @ORM\ManyToOne(targetEntity="OptionType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="option_type_id", referencedColumnName="id")
     * })
     */
    private $optionType;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Vehicle", mappedBy="options")
     */
    private $vehicle = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehicle = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
