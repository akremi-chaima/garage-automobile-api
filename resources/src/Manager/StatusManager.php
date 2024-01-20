<?php
namespace App\Manager;

use App\Entity\Status;
use Doctrine\ORM\EntityManagerInterface;

class StatusManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Status::class);
    }
}