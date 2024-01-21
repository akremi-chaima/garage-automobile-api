<?php
namespace App\Controller\Feedback;

use App\Entity\User;
use App\Manager\FeedbackManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetAdministrationFeedbacksController extends AbstractController
{
    /** @var FeedbackManager */
    private $feedbackManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param FeedbackManager $feedbackManager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        FeedbackManager $feedbackManager,
        SerializerInterface $serializer
    ) {
        $this->feedbackManager = $feedbackManager;
        $this->serializer = $serializer;
    }

    /**
     * Get administration feedbacks
     *
     * @Route("/api/private/feedbacks/{page}/{itemsPerPage}", methods={"GET"})
     *
     * @OA\Tag(name="Feedback")
     *
     * @OA\Response(response=200, description="Feedbacks list")
     * @OA\Response(response=400, description="The user should be administrator or employee")
     *
     * @param UserInterface $user
     * @param int $page
     * @param int $itemsPerPage
     * @return JsonResponse
     */
    public function __invoke(UserInterface $user, int $page, int $itemsPerPage): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles()) && !in_array(User::ROLE_EMPLOYEE, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator or employee'], Response::HTTP_BAD_REQUEST);
        }

        $feedbacksTotalNumber = $this->feedbackManager->count([]);
        $feedbacksPaginator = $this->feedbackManager->get([], $page, $itemsPerPage);
        $result = [
            'data' => json_decode($this->serializer->serialize($feedbacksPaginator->getItems(), 'json'), true),
            'currentPage' => $page,
            'totalItems' => $feedbacksTotalNumber,
        ];
        return new JsonResponse($result, Response::HTTP_OK);
    }
}