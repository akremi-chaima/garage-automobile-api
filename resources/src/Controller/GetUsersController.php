<?php
namespace App\Controller;

use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetUsersController extends AbstractController
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
     * Get users list
     *
     * @Route("/api/private/users", methods={"GET"})
     *
     * @OA\Tag(name="Users")
     *
     * @OA\Response(response=200, description="Users list")
     * 
     * @param UserInterface $user
     * @return JsonResponse
     */
    public function __invoke(UserInterface $user): JsonResponse
    {
        if (!in_array('administrator', $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator.'], Response::HTTP_BAD_REQUEST);
        }

        $users = $this->userManager->findAll();
        $normalizedList = $this->serializer->serialize($users, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}