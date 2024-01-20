<?php
namespace App\Manager;

use App\Entity\Feedback;
use App\Entity\Status;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class FeedbackManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $managerInterface
     * @param PaginatorInterface $paginator
     */
    public function __construct(
        EntityManagerInterface $managerInterface,
        PaginatorInterface $paginator
    )
    {
        parent::__construct($managerInterface, Feedback::class);
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
            ->select('feedback')
            ->from(Feedback::class, 'feedback');

        if (isset($params['status'])) {
            $queryBuilder->innerJoin(Status::class, 'status')
                ->where('feedback.status = status')
                ->andWhere('status.code = :code')
                ->setParameter(':code', $params['status']);
        }
        $queryBuilder->orderBy('feedback.createdAt', 'DESC');
        return $this->paginator->paginate($queryBuilder, $page, $itemsPerPage);
    }

    /**
     * @param array $params
     * @return int
     */
    public function count(array $params) {
        try {
            $queryBuilder =  $this->getEntityManager()->createQueryBuilder()
                ->select('count(feedback.id)')
                ->from(Feedback::class, 'feedback');

            if (isset($params['status'])) {
                $queryBuilder->innerJoin(Status::class, 'status')
                    ->where('feedback.status = status')
                    ->andWhere('status.code = :code')
                    ->setParameter(':code', $params['status']);
            }

            return intval($queryBuilder->getQuery()->getSingleScalarResult());
        } catch (\Exception $exception) {
            return 0;
        }
    }

    /**
     * @param Feedback $feedback
     * @return void
     */
    public function save(Feedback $feedback) {
        $this->getEntityManager()->persist($feedback);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Feedback $feedback
     * @return void
     */
    public function delete(Feedback $feedback) {
        $this->getEntityManager()->remove($feedback);
        $this->getEntityManager()->flush();
    }
}