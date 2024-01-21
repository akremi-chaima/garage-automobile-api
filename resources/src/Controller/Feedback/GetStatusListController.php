<?php
namespace App\Controller\Feedback;

use App\Entity\User;
use App\Manager\StatusManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetStatusListController extends AbstractController
{
    /** @var StatusManager */
    private $statusManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param StatusManager $statusManager
     * @param SerializerInterface $serializer
     */
    public function __construct(StatusManager $statusManager, SerializerInterface $serializer)
    {
        $this->statusManager = $statusManager;
        $this->serializer = $serializer;
    }

    /**
     * Get feedback status list
     *
     * @Route("/api/private/status/list", methods={"GET"})
     *
     * @OA\Tag(name="Feedback")
     *
     * @OA\Response(response=200, description="Status list")
     * @OA\Response(response=400, description="he user should be administrator or employee")
     *
     * @param UserInterface $user
     * @return JsonResponse
     */
    public function __invoke(UserInterface $user): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles()) && !in_array(User::ROLE_EMPLOYEE, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator or employee'], Response::HTTP_BAD_REQUEST);
        }

        $status = $this->statusManager->findAll();
        $normalizedList = $this->serializer->serialize($status, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}