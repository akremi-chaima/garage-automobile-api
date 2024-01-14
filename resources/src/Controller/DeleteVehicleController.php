<?php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Vehicle;
use App\Manager\VehicleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @Route("/api/private/vehicle/{id}", methods={"DELETE"})
     *
     * @OA\Tag(name="Vehicles")
     *
     * @OA\Response(response=200, description="Vehicle deleted")
     * @OA\Response(response=400, description="The user should be administrator or employee | The vehicle is not found")
     *
     * @param UserInterface $user
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UserInterface $user, int $id): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles()) && !in_array(User::ROLE_EMPLOYEE, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator or employee.'], Response::HTTP_BAD_REQUEST);
        }

        /** @var Vehicle|null $vehicle */
        $vehicle = $this->vehicleManager->findOneBy(['id' => $id]);
        if (empty($vehicle)) {
            return new JsonResponse(['error_message' => 'The vehicle is not found'], Response::HTTP_BAD_REQUEST);
        }

        $this->vehicleManager->delete($vehicle);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}