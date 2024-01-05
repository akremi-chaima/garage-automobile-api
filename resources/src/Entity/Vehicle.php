<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle", indexes={@ORM\Index(name="fk_vehicle_model1_idx", columns={"model_id"}), @ORM\Index(name="fk_vehicle_gearbox1_idx", columns={"gearbox_id"}), @ORM\Index(name="fk_vehicle_energy1_idx", columns={"energy_id"}), @ORM\Index(name="fk_vehicle_color_idx", columns={"color_id"})})
 * @ORM\Entity
 */
class Vehicle
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
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="circulation_year", type="date", nullable=false)
     */
    private $circulationYear;

    /**
     * @var int
     *
     * @ORM\Column(name="mileage", type="integer", nullable=false)
     */
    private $mileage;

    /**
     * @var int
     *
     * @ORM\Column(name="fiscal_power", type="integer", nullable=false)
     */
    private $fiscalPower;

    /**
     * @var int
     *
     * @ORM\Column(name="manufacturing_year", type="integer", nullable=false)
     */
    private $manufacturingYear;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $active = true;

    /**
     * @var \Color
     *
     * @ORM\ManyToOne(targetEntity="Color")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     * })
     */
    private $color;

    /**
     * @var \Energy
     *
     * @ORM\ManyToOne(targetEntity="Energy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="energy_id", referencedColumnName="id")
     * })
     */
    private $energy;

    /**
     * @var \Gearbox
     *
     * @ORM\ManyToOne(targetEntity="Gearbox")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gearbox_id", referencedColumnName="id")
     * })
     */
    private $gearbox;

    /**
     * @var \Model
     *
     * @ORM\ManyToOne(targetEntity="Model")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     * })
     */
    private $model;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Options", inversedBy="vehicle")
     * @ORM\JoinTable(name="vehicle_options",
     *   joinColumns={
     *     @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="options_id", referencedColumnName="id")
     *   }
     * )
     */
    private $options = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
