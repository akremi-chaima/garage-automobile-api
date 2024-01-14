<?php
namespace App\Controller;

use App\Manager\VehicleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetVehicleController extends AbstractController
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
     * Get vehicle by id
     *
     * @Route("/api/vehicles/{id}", methods={"GET"})
     *
     * @OA\Tag(name="Vehicles")
     *
     * @OA\Response(response=200, description="Vehicle")
     * @OA\Response(response=400, description="Vehicle not found")
     * @OA\Response(response=400, description="Invalid user role")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $vehicle = $this->vehicleManager->findOneBy(['id' => $id]);
        if (is_null($vehicle)) {
            return new JsonResponse(['error_message' => 'The vehicle is not found'], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse(json_decode($this->serializer->serialize($vehicle, 'json'), true), Response::HTTP_OK);
    }
}