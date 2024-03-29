<?php
namespace App\Controller\Vehicle;

use App\DTO\Vehicle\AddVehicleDTO;
use App\Entity\Color;
use App\Entity\Energy;
use App\Entity\Gearbox;
use App\Entity\Model;
use App\Entity\Options;
use App\Entity\User;
use App\Entity\Vehicle;
use App\Manager\ColorManager;
use App\Manager\EnergyManager;
use App\Manager\GearboxManager;
use App\Manager\ModelManager;
use App\Manager\OptionsManager;
use App\Manager\VehicleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddVehicleController extends AbstractController
{
    /** @var VehicleManager */
    private $vehicleManager;

    /** @var ColorManager */
    private $colorManager;

    /** @var ModelManager */
    private $modelManager;

    /** @var GearboxManager */
    private $gearboxManager;

    /** @var EnergyManager */
    private $energyManager;

    /** @var OptionsManager */
    private $optionsManager;

    /** @var SerializerInterface */
    private $serializer;

    /** @var ValidatorInterface */
    protected $validator;

    /**
     * @param VehicleManager $vehicleManager
     * @param ColorManager $colorManager
     * @param ModelManager $modelManager
     * @param GearboxManager $gearboxManager
     * @param EnergyManager $energyManager
     * @param OptionsManager $optionsManager
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        VehicleManager $vehicleManager,
        ColorManager $colorManager,
        ModelManager $modelManager,
        GearboxManager $gearboxManager,
        EnergyManager $energyManager,
        OptionsManager $optionsManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->vehicleManager = $vehicleManager;
        $this->colorManager = $colorManager;
        $this->modelManager = $modelManager;
        $this->gearboxManager = $gearboxManager;
        $this->energyManager = $energyManager;
        $this->optionsManager = $optionsManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Add vehicle
     *
     * @Route("/api/private/vehicle", methods={"POST"})
     *
     * @OA\Tag(name="Vehicles")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"price", "circulationDate", "mileage", "fiscalPower", "manufacturingYear", "colorId", "energyId", "gearboxId", "modelId", "optionsIds"},
     *              @OA\Property(property="price", type="float"),
     *              @OA\Property(property="circulationDate", type="string"),
     *              @OA\Property(property="mileage", type="integer"),
     *              @OA\Property(property="fiscalPower", type="integer"),
     *              @OA\Property(property="manufacturingYear", type="integer"),
     *              @OA\Property(property="colorId", type="integer"),
     *              @OA\Property(property="energyId", type="integer"),
     *              @OA\Property(property="gearboxId", type="integer"),
     *              @OA\Property(property="modelId", type="integer"),
     *              @OA\Property(property="optionsIds", type="array", @OA\Items(type="integer")),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="Vehicle saved")
     * @OA\Response(response=400, description="The user should be administrator or employee | The color was not found | The gearbox was not found | The energy was not found | The model was not found | The options should not be empty | The option was not found")
     *
     * @param Request $request
     * @param UserInterface $user
     * @return JsonResponse
     */
    public function __invoke(Request $request, UserInterface $user): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles()) && !in_array(User::ROLE_EMPLOYEE, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator or employee'], Response::HTTP_BAD_REQUEST);
        }

        /** @var AddVehicleDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), AddVehicleDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }

        // validate selected color
        /** @var Color $color */
        $color = $this->colorManager->findOneBy(['id' => $dto->getColorId()]);
        if (is_null($color)) {
            return new JsonResponse(['error_message' => 'The color was not found'], Response::HTTP_BAD_REQUEST);
        }

        // validate selected gearbox
        /** @var Gearbox $gearbox */
        $gearbox = $this->gearboxManager->findOneBy(['id' => $dto->getGearboxId()]);
        if (is_null($gearbox)) {
            return new JsonResponse(['error_message' => 'The gearbox was not found'], Response::HTTP_BAD_REQUEST);
        }

        // validate selected energy
        /** @var Energy $energy */
        $energy = $this->energyManager->findOneBy(['id' => $dto->getEnergyId()]);
        if (is_null($energy)) {
            return new JsonResponse(['error_message' => 'The energy was not found'], Response::HTTP_BAD_REQUEST);
        }

        // validate selected model
        /** @var Model $model */
        $model = $this->modelManager->findOneBy(['id' => $dto->getModelId()]);
        if (is_null($model)) {
            return new JsonResponse(['error_message' => 'The model was not found'], Response::HTTP_BAD_REQUEST);
        }

        // validate selected options
        if (count($dto->getOptionsIds()) == 0) {
            return new JsonResponse(['error_message' => 'The options should not be empty'], Response::HTTP_BAD_REQUEST);
        }

        $options = [];
        foreach ($dto->getOptionsIds() as $optionId) {
            /** @var Options $option */
            $option = $this->optionsManager->findOneBy(['id' => $optionId]);
            if (is_null($option)) {
                return new JsonResponse(['error_message' => 'The option was not found'], Response::HTTP_BAD_REQUEST);
            }
            $options[] = $option;
        }

        $vehicle = (new Vehicle())
            ->setPrice($dto->getPrice())
            ->setMileage($dto->getMileage())
            ->setManufacturingYear($dto->getManufacturingYear())
            ->setFiscalPower($dto->getFiscalPower())
            ->setCirculationDate(new \DateTime($dto->getCirculationDate()))
            ->setColor($color)
            ->setEnergy($energy)
            ->setGearbox($gearbox)
            ->setModel($model)
            ->setOptions($options);

        $this->vehicleManager->save($vehicle);
        return new JsonResponse(['vehicleId' => $vehicle->getId()], Response::HTTP_OK);
    }
}