<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * Picture
 *
 * @ORM\Table(name="picture", indexes={@ORM\Index(name="fk_picture_vehicle1_idx", columns={"vehicle_id"})})
 * @ORM\Entity
 */
class Picture
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
     * @ORM\Column(name="url", type="string", length=200, nullable=false)
     */
    private $url;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_principal", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isPrincipal = true;

    /**
     * @var \Vehicle
     *
     * @ORM\ManyToOne(targetEntity="Vehicle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     * })
     */
    private $vehicle;


}
