<?php
namespace App\Manager;

use App\Entity\Model;
use Doctrine\ORM\EntityManagerInterface;

class ModelManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Model::class);
    }
}