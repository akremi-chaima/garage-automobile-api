<?php
namespace App\Controller;

use App\DTO\AddOpeningHourDTO;
use App\Entity\OpeningHours;
use App\Entity\User;
use App\Manager\OpeningHoursManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddOpeningHourController extends AbstractController
{
    /** @var OpeningHoursManager */
    private $openingHoursManager;

    /** @var SerializerInterface */
    private $serializer;

    /** @var ValidatorInterface */
    protected $validator;

    /**
     * @param OpeningHoursManager $openingHoursManager
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        OpeningHoursManager $openingHoursManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->openingHoursManager = $openingHoursManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Add opening hour
     *
     * @Route("/api/private/opening/hour", methods={"POST"})
     *
     * @OA\Tag(name="Opening Hours")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"day"},
     *              @OA\Property(property="day", type="string"),
     *              @OA\Property(property="morningStartHour", type="string"),
     *              @OA\Property(property="morningEndHour", type="string"),
     *              @OA\Property(property="afternoonStartHour", type="string"),
     *              @OA\Property(property="afternoonEndHour", type="string"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="Opening hour saved")
     * @OA\Response(response=400, description="The user should be administrator")
     *
     * @param Request $request
     * @param UserInterface $user
     * @return JsonResponse
     */
    public function __invoke(Request $request, UserInterface $user): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator'], Response::HTTP_BAD_REQUEST);
        }

        /** @var AddOpeningHourDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), AddOpeningHourDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }

        $openingHour = (new OpeningHours())
            ->setDay($dto->getDay())
            ->setMorningStartHour($dto->getMorningStartHour())
            ->setMorningEndHour($dto->getMorningEndHour())
            ->setAfternoonStartHour($dto->getAfternoonStartHour())
            ->setAfternoonEndHour($dto->getAfternoonEndHour());

        $this->openingHoursManager->save($openingHour);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}