<?php
namespace App\Manager;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;

class VehicleManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Vehicle::class);
    }

    /**
     * @param Vehicle $vehicle
     * @return void
     */
    public function save(Vehicle $vehicle) {
        $this->getEntityManager()->persist($vehicle);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Vehicle $vehicle
     * @return void
     */
    public function delete(Vehicle $vehicle) {
        $this->getEntityManager()->remove($vehicle);
        $this->getEntityManager()->flush();
    }
}