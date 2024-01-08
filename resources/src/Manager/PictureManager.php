<?php
namespace App\Manager;

use App\Entity\Picture;
use Doctrine\ORM\EntityManagerInterface;

class PictureManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     */
    public function __construct(
        EntityManagerInterface $managerInterface
    )
    {
        parent::__construct($managerInterface, Picture::class);
    }

    /**
     * @param Picture $picture
     * @return void
     */
    public function save(Picture $picture) {
        $this->getEntityManager()->persist($picture);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Picture $picture
     * @return void
     */
    public function delete(Picture $picture) {
        $this->getEntityManager()->remove($picture);
        $this->getEntityManager()->flush();
    }
}