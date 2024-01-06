<?php
namespace App\Manager;

use App\Entity\Options;
use Doctrine\ORM\EntityManagerInterface;

class OptionsManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Options::class);
    }
}