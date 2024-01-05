<?php
namespace App\Manager;

use App\Entity\Brand;
use Doctrine\ORM\EntityManagerInterface;

class BrandManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Brand::class);
    }
}