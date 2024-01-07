<?php
namespace App\Controller;

use App\Manager\VehicleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

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
     * @Route("/api/vehicles", methods={"GET"})
     *
     * @OA\Tag(name="Vehicles")
     *
     * @OA\Response(response=200, description="Vehicles list")
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $vehicles = $this->vehicleManager->findAll();
        $normalizedList = $this->serializer->serialize($vehicles, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}