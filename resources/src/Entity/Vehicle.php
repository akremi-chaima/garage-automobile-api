<?php
namespace App\Entity;

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
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="circulation_date", type="date", nullable=false)
     */
    private $circulationDate;

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
     * @var Color
     *
     * @ORM\ManyToOne(targetEntity="Color")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     * })
     */
    private $color;

    /**
     * @var Energy
     *
     * @ORM\ManyToOne(targetEntity="Energy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="energy_id", referencedColumnName="id")
     * })
     */
    private $energy;

    /**
     * @var Gearbox
     *
     * @ORM\ManyToOne(targetEntity="Gearbox")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gearbox_id", referencedColumnName="id")
     * })
     */
    private $gearbox;

    /**
     * @var Model
     *
     * @ORM\ManyToOne(targetEntity="Model")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     * })
     */
    private $model;

    /**
     * @var Options[] $options
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Vehicle
     */
    public function setPrice(float $price): Vehicle
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCirculationDate(): \DateTime
    {
        return $this->circulationDate;
    }

    /**
     * @param \DateTime $circulationDate
     * @return Vehicle
     */
    public function setCirculationDate(\DateTime $circulationDate): Vehicle
    {
        $this->circulationDate = $circulationDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getMileage(): int
    {
        return $this->mileage;
    }

    /**
     * @param int $mileage
     * @return Vehicle
     */
    public function setMileage(int $mileage): Vehicle
    {
        $this->mileage = $mileage;
        return $this;
    }

    /**
     * @return int
     */
    public function getFiscalPower(): int
    {
        return $this->fiscalPower;
    }

    /**
     * @param int $fiscalPower
     * @return Vehicle
     */
    public function setFiscalPower(int $fiscalPower): Vehicle
    {
        $this->fiscalPower = $fiscalPower;
        return $this;
    }

    /**
     * @return int
     */
    public function getManufacturingYear(): int
    {
        return $this->manufacturingYear;
    }

    /**
     * @param int $manufacturingYear
     * @return Vehicle
     */
    public function setManufacturingYear(int $manufacturingYear): Vehicle
    {
        $this->manufacturingYear = $manufacturingYear;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Vehicle
     */
    public function setActive(bool $active): Vehicle
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return Color
     */
    public function getColor(): Color
    {
        return $this->color;
    }

    /**
     * @param Color $color
     * @return Vehicle
     */
    public function setColor(Color $color): Vehicle
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return Energy
     */
    public function getEnergy(): Energy
    {
        return $this->energy;
    }

    /**
     * @param Energy $energy
     * @return Vehicle
     */
    public function setEnergy(Energy $energy): Vehicle
    {
        $this->energy = $energy;
        return $this;
    }

    /**
     * @return Gearbox
     */
    public function getGearbox(): Gearbox
    {
        return $this->gearbox;
    }

    /**
     * @param Gearbox $gearbox
     * @return Vehicle
     */
    public function setGearbox(Gearbox $gearbox): Vehicle
    {
        $this->gearbox = $gearbox;
        return $this;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     * @return Vehicle
     */
    public function setModel(Model $model): Vehicle
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return Options[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getOptions(): \Doctrine\Common\Collections\ArrayCollection|array
    {
        return $this->options;
    }

    /**
     * @param Options[]|\Doctrine\Common\Collections\ArrayCollection $options
     * @return Vehicle
     */
    public function setOptions(\Doctrine\Common\Collections\ArrayCollection|array $options): Vehicle
    {
        $this->options = $options;
        return $this;
    }
}
