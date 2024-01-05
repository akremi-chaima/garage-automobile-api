<?php
namespace App\Manager;

use App\Entity\Energy;
use Doctrine\ORM\EntityManagerInterface;

class EnergyManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Energy::class);
    }
}