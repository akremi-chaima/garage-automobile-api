<?php
namespace App\Manager;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;

class ServiceManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Service::class);
    }

    /**
     * @param Service $service
     * @return void
     */
    public function save(Service $service) {
        $this->getEntityManager()->persist($service);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Service $service
     * @return void
     */
    public function delete(Service $service) {
        $this->getEntityManager()->remove($service);
        $this->getEntityManager()->flush();
    }
}