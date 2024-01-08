<?php
namespace App\Controller;

use App\Entity\Vehicle;
use App\Manager\VehicleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class DeleteVehicleController extends AbstractController
{
    /** @var VehicleManager */
    private $vehicleManager;

    /**
     * @param VehicleManager $vehicleManager
     */
    public function __construct(VehicleManager $vehicleManager) {
        $this->vehicleManager = $vehicleManager;
    }

    /**
     * Delete vehicle
     *
     * @Route("/api/vehicle/{id}", methods={"DELETE"})
     *
     * @OA\Tag(name="Vehicles")
     *
     * @OA\Response(response=200, description="Vehicle deleted")
     * @OA\Response(response=400, description="Error occurred")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        /** @var Vehicle|null $vehicle */
        $vehicle = $this->vehicleManager->findOneBy(['id' => $id]);
        if (empty($vehicle)) {
            return new JsonResponse(['error_message' => 'Vehicle not found'], Response::HTTP_BAD_REQUEST);
        }

        $this->vehicleManager->delete($vehicle);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}