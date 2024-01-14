<?php
namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class DeleteUserController extends AbstractController
{
    /** @var UserManager */
    private $userManager;

    /**
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager) {
        $this->userManager = $userManager;
    }

    /**
     * Delete user by id
     *
     * @Route("/api/private/user/{id}", methods={"DELETE"})
     *
     * @OA\Tag(name="Users")
     *
     * @OA\Response(response=200, description="User delete")
     * @OA\Response(response=400, description="The user should be administrator | The user not found")
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

        /** @var User|null $userById */
        $userById = $this->userManager->findOneBy(['id' => $id]);
        if (is_null($userById)) {
            return new JsonResponse(['error_message' => 'The user not found'], Response::HTTP_BAD_REQUEST);
        }

        $this->userManager->delete($userById);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}