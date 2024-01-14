<?php
namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetUserController extends AbstractController
{
    /** @var UserManager */
    private $userManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param UserManager $userManager
     * @param SerializerInterface $serializer
     */
    public function __construct(UserManager $userManager, SerializerInterface $serializer)
    {
        $this->userManager = $userManager;
        $this->serializer = $serializer;
    }

    /**
     * Get user by id
     *
     * @Route("/api/private/user/{id}", methods={"GET"})
     *
     * @OA\Tag(name="Users")
     *
     * @OA\Response(response=200, description="User")
     * @OA\Response(response=400, description="The user should be administrator | The user is not found")
     *
     * @param UserInterface $user
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UserInterface $user, int $id): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator.'], Response::HTTP_BAD_REQUEST);
        }

        /** @var User|null $user */
        $user = $this->userManager->findOneBy(['id' => $id]);
        if (empty($user)) {
            return new JsonResponse(['error_message' => 'The user is not found'], Response::HTTP_BAD_REQUEST);
        }
        $normalizedUser = $this->serializer->serialize($user, 'json');
        return new JsonResponse(json_decode($normalizedUser, true), Response::HTTP_OK);
    }
}