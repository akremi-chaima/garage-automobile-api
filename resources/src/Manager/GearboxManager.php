<?php
namespace App\Manager;

use App\Entity\Gearbox;
use Doctrine\ORM\EntityManagerInterface;

class GearboxManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Gearbox::class);
    }
}