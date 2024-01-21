<?php
namespace App\Controller\Feedback;

use App\DTO\Feedback\AddFeedbackDTO;
use App\Entity\Feedback;
use App\Entity\Status;
use App\Entity\User;
use App\Manager\FeedbackManager;
use App\Manager\StatusManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddFeedbackByConnectedEmployeeController extends AbstractController
{
    /** @var FeedbackManager */
    private $feedbackManager;

    /** @var StatusManager */
    private $statusManager;

    /** @var SerializerInterface */
    private $serializer;

    /** @var ValidatorInterface */
    protected $validator;


    /**
     * @param FeedbackManager $feedbackManager
     * @param StatusManager $statusManager
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        FeedbackManager $feedbackManager,
        StatusManager $statusManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->feedbackManager = $feedbackManager;
        $this->statusManager = $statusManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Add feedback by connected employee
     *
     * @Route("/api/private/feedback", methods={"POST"})
     *
     * @OA\Tag(name="Feedback")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"firstname", "lastname", "message", "stars"},
     *              @OA\Property(property="firstname", type="string"),
     *              @OA\Property(property="lastname", type="string"),
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(property="stars", type="integer"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="Feedback saved")
     * @OA\Response(response=400, description="Invalid data | The status is not found | The user should be administrator or employee")
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

        /** @var AddFeedbackDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), AddFeedbackDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }

        // Get visible status by code
        /** @var Status|null $status */
        $status = $this->statusManager->findOneBy(['code' => Status::STATUS_CODE_VISIBLE]);
        if (empty($status)) {
            return new JsonResponse(['error_message' => 'The status is not found'], Response::HTTP_BAD_REQUEST);
        }

        $feedback = (new Feedback())
            ->setLastname($dto->getLastname())
            ->setFirstname($dto->getFirstname())
            ->setMessage($dto->getMessage())
            ->setStars($dto->getStars())
            ->setStatus($status)
            ->setCreatedAt(new \DateTime());

        $this->feedbackManager->save($feedback);

        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}