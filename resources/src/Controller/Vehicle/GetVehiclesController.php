<?php
namespace App\Controller\Vehicle;

use App\DTO\Vehicle\VehiclesFilterDTO;
use App\Manager\VehicleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GetVehiclesController extends AbstractController
{
    /** @var VehicleManager */
    private $vehicleManager;

    /** @var SerializerInterface */
    private $serializer;

    /** @var ValidatorInterface */
    protected $validator;

    /**
     * @param VehicleManager $vehicleManager
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        VehicleManager $vehicleManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->vehicleManager = $vehicleManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Get vehicles list
     *
     * @Route("/api/vehicles/{page}/{itemsPerPage}", methods={"POST"})
     *
     * @OA\Tag(name="Vehicles")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *             @OA\Property(property="brandId", type="integer"),
     *              @OA\Property(property="modelId", type="integer"),
     *              @OA\Property(property="minPrice", type="float"),
     *              @OA\Property(property="maxPrice", type="float"),
     *              @OA\Property(property="minMileage", type="integer"),
     *              @OA\Property(property="maxMileage", type="integer"),
     *              @OA\Property(property="minManufacturingYear", type="integer"),
     *              @OA\Property(property="maxManufacturingYear", type="integer"),
     *              @OA\Property(property="fiscalPower", type="integer"),
     *              @OA\Property(property="colorId", type="integer"),
     *              @OA\Property(property="energyId", type="integer"),
     *              @OA\Property(property="gearboxId", type="integer"),
     *              @OA\Property(property="orderBy", type="string"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="Vehicles list")
     *
     * @param Request $request
     * @param int $page
     * @param int $itemsPerPage
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $page, int $itemsPerPage): JsonResponse
    {
        /** @var VehiclesFilterDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), VehiclesFilterDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }


        $vehiclesTotalNumber = $this->vehicleManager->count($dto);
        $vehiclesPaginator = $this->vehicleManager->get($dto, $page, $itemsPerPage);
        $result = [
            'data' => json_decode($this->serializer->serialize($vehiclesPaginator->getItems(), 'json'), true),
            'currentPage' => $page,
            'totalItems' => $vehiclesTotalNumber,
        ];
        return new JsonResponse($result, Response::HTTP_OK);
    }
}