<?php
namespace App\Manager;

use App\Entity\Color;
use Doctrine\ORM\EntityManagerInterface;

class ColorManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Color::class);
    }
}