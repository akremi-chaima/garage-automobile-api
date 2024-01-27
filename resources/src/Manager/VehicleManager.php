<?php
namespace App\Manager;

use App\DTO\Vehicle\VehiclesFilterDTO;
use App\Entity\Brand;
use App\Entity\Color;
use App\Entity\Energy;
use App\Entity\Gearbox;
use App\Entity\Model;
use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\This;

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
     * @param VehiclesFilterDTO $dto
     * @param int $page
     * @param int $itemsPerPage
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function get(VehiclesFilterDTO $dto, int $page, int $itemsPerPage) {
        $queryBuilder =  $this->getEntityManager()->createQueryBuilder()
            ->select('vehicle')
            ->from(Vehicle::class, 'vehicle');

        $queryBuilder = $this->filterQueryBuilder($dto, $queryBuilder);

        return $this->paginator->paginate($queryBuilder, $page, $itemsPerPage);
    }

    /**
     * @param VehiclesFilterDTO $dto
     * @return int
     */
    public function count(VehiclesFilterDTO $dto) {
        try {
            $queryBuilder =  $this->getEntityManager()->createQueryBuilder()
                ->select('count(vehicle.id)')
                ->from(Vehicle::class, 'vehicle');

            $queryBuilder = $this->filterQueryBuilder($dto, $queryBuilder);

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

    /**
     * @param VehiclesFilterDTO $dto
     * @param QueryBuilder $queryBuilder
     * @return QueryBuilder
     */
    private function filterQueryBuilder(VehiclesFilterDTO $dto, QueryBuilder $queryBuilder) {

        if (!empty($dto->getFiscalPower())) {
            $queryBuilder->andWhere('vehicle.fiscalPower = :fiscalPower')
                ->setParameter(':fiscalPower', $dto->getFiscalPower());
        }

        if (!empty($dto->getMaxManufacturingYear())) {
            $queryBuilder->andWhere('vehicle.manufacturingYear <= :maxManufacturingYear')
                ->setParameter(':maxManufacturingYear', $dto->getMaxManufacturingYear());
        }

        if (!empty($dto->getMinManufacturingYear())) {
            $queryBuilder->andWhere('vehicle.manufacturingYear >= :minManufacturingYear')
                ->setParameter(':minManufacturingYear', $dto->getMinManufacturingYear());
        }

        if (!empty($dto->getMaxMileage())) {
            $queryBuilder->andWhere('vehicle.mileage <= :maxMileage')
                ->setParameter(':maxMileage', $dto->getMaxMileage());
        }

        if (!empty($dto->getMinMileage())) {
            $queryBuilder->andWhere('vehicle.mileage >= :minMileage')
                ->setParameter(':minMileage', $dto->getMinMileage());
        }

        if (!empty($dto->getMaxPrice())) {
            $queryBuilder->andWhere('vehicle.price <= :maxPrice')
                ->setParameter(':maxPrice', $dto->getMaxPrice());
        }

        if (!empty($dto->getMinPrice())) {
            $queryBuilder->andWhere('vehicle.price >= :minPrice')
                ->setParameter(':minPrice', $dto->getMinPrice());
        }

        if (!empty($dto->getColorId())) {
            $queryBuilder->join(Color::class, 'color', 'WITH', 'color = vehicle.color')
                ->andWhere('color.id = :colorId')
                ->setParameter(':colorId', $dto->getColorId());
        }

        if (!empty($dto->getEnergyId())) {
            $queryBuilder->join(Energy::class, 'energy', 'WITH', 'energy = vehicle.energy')
                ->andWhere('energy.id = :energyId')
                ->setParameter(':energyId', $dto->getEnergyId());
        }

        if (!empty($dto->getGearboxId())) {
            $queryBuilder->join(Gearbox::class, 'gearbox', 'WITH', 'gearbox = vehicle.gearbox')
                ->andWhere('gearbox.id = :gearboxId')
                ->setParameter(':gearboxId', $dto->getGearboxId());
        }

        if (!empty($dto->getModelId()) || !empty($dto->getBrandId())) {
            $queryBuilder->join(Model::class, 'model', 'WITH', 'model = vehicle.model');
            if (!empty($dto->getBrandId())) {
                $queryBuilder->join(Brand::class, 'brand', 'WITH', 'brand = model.brand')
                    ->andWhere('brand.id = :brandId')
                    ->setParameter(':brandId', $dto->getBrandId());
            }
            if (!empty($dto->getModelId())) {
                $queryBuilder->andWhere('model.id = :modelId')
                    ->setParameter(':modelId', $dto->getModelId());
            }
        }

        if (!empty($dto->getOrderBy())) {
            switch ($dto->getOrderBy()) {
                case 'asc_price':
                    $queryBuilder->orderBy('vehicle.price', 'ASC');
                    break;
                case 'desc_price':
                    $queryBuilder->orderBy('vehicle.price', 'DESC');
                    break;
                case 'asc_mileage':
                    $queryBuilder->orderBy('vehicle.mileage', 'ASC');
                    break;
                case 'desc_mileage':
                    $queryBuilder->orderBy('vehicle.mileage', 'DESC');
                    break;
                case 'desc_manufacturing_year':
                    $queryBuilder->orderBy('vehicle.manufacturingYear', 'DESC');
                    break;
                case 'asc_manufacturing_year':
                    $queryBuilder->orderBy('vehicle.manufacturingYear', 'ASC');
                    break;
            }
        }

        return $queryBuilder;
    }
}