<?php
namespace App\Manager;

use App\Entity\OpeningHours;
use Doctrine\ORM\EntityManagerInterface;

class OpeningHoursManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, OpeningHours::class);
    }

    /**
     * @param OpeningHours $openingHours
     * @return void
     */
    public function save(OpeningHours $openingHours) {
        $this->getEntityManager()->persist($openingHours);
        $this->getEntityManager()->flush();
    }
}