<?php
namespace App\Controller;

use App\Manager\VehicleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use \Knp\Component\Pager\Pagination\PaginationInterface;

class GetVehiclesController extends AbstractController
{
    /** @var VehicleManager */
    private $vehicleManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param VehicleManager $vehicleManager
     * @param SerializerInterface $serializer
     */
    public function __construct(VehicleManager $vehicleManager, SerializerInterface $serializer)
    {
        $this->vehicleManager = $vehicleManager;
        $this->serializer = $serializer;
    }

    /**
     * Get vehicles list
     *
     * @Route("/api/vehicles/{page}/{itemsPerPage}", methods={"POST"})
     *
     * @OA\Tag(name="Vehicles")
     *
     * @OA\Response(response=200, description="Vehicles list")
     *
     * @param int $page
     * @param int $itemsPerPage
     * @return JsonResponse
     */
    public function __invoke(int $page, int $itemsPerPage): JsonResponse
    {
        $vehiclesTotalNumber = $this->vehicleManager->count([]);
        $vehiclesPaginator = $this->vehicleManager->get([], $page, $itemsPerPage);
        $result = [
            'data' => json_decode($this->serializer->serialize($vehiclesPaginator->getItems(), 'json'), true),
            'currentPage' => $page,
            'totalItems' => $vehiclesTotalNumber,
        ];
        return new JsonResponse($result, Response::HTTP_OK);
    }
}