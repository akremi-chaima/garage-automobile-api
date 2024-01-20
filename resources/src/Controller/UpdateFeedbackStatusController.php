<?php
namespace App\Controller;

use App\DTO\UpdateFeedbackStatusDTO;
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

class UpdateFeedbackStatusController extends AbstractController
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
     * Update feedback status
     *
     * @Route("/api/private/feedback/status", methods={"PUT"})
     *
     * @OA\Tag(name="Feedback")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"id", "statusCode"},
     *              @OA\Property(property="id", type="integer"),
     *              @OA\Property(property="statusCode", type="string"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="Feedback updated")
     * @OA\Response(response=400, description="The feedback not found | The status is not found")
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

        /** @var UpdateFeedbackStatusDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), UpdateFeedbackStatusDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }

        // Get selected status by code
        /** @var Status|null $status */
        $status = $this->statusManager->findOneBy(['code' => $dto->getStatusCode()]);
        if (empty($status)) {
            return new JsonResponse(['error_message' => 'The status is not found'], Response::HTTP_BAD_REQUEST);
        }

        // Get feedback to update by id
        /** @var Feedback|null $feedback */
        $feedback = $this->feedbackManager->findOneBy(['id' => $dto->getId()]);
        if (empty($feedback)) {
            return new JsonResponse(['error_message' => 'The feedback is not found'], Response::HTTP_BAD_REQUEST);
        }

        $feedback->setStatus($status);
        $this->feedbackManager->save($feedback);

        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}