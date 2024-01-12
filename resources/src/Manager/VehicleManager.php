<?php
namespace App\Manager;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class VehicleManager extends AbstractManager
{
    /** @var PaginatorInterface */
    private $paginator;

    /**
     * @param EntityManagerInterface $managerInterface
     * @param PaginatorInterface $paginator
     */
    public function __construct(
        EntityManagerInterface $managerInterface,
        PaginatorInterface $paginator
    )
    {
        parent::__construct($managerInterface, Vehicle::class);
        $this->paginator = $paginator;
    }

    /**
     * @param array $params
     * @param int $page
     * @param int $itemsPerPage
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function get(array $params, int $page, int $itemsPerPage) {
        $queryBuilder =  $this->getEntityManager()->createQueryBuilder()
            ->select('vehicle')
            ->from(Vehicle::class, 'vehicle');

        return $this->paginator->paginate($queryBuilder, $page, $itemsPerPage);
    }

    /**
     * @param array $params
     * @return int
     */
    public function count(array $params) {
        try {
            $queryBuilder =  $this->getEntityManager()->createQueryBuilder()
                ->select('count(vehicle.id)')
                ->from(Vehicle::class, 'vehicle');

            return intval($queryBuilder->getQuery()->getSingleScalarResult());
        } catch (\Exception $exception) {
            return 0;
        }
    }

    /**
     * @param Vehicle $vehicle
     * @return void
     */
    public function save(Vehicle $vehicle) {
        $this->getEntityManager()->persist($vehicle);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Vehicle $vehicle
     * @return void
     */
    public function delete(Vehicle $vehicle) {
        $this->getEntityManager()->remove($vehicle);
        $this->getEntityManager()->flush();
    }
}