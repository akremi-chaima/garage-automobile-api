<?php
namespace App\Controller\Service;

use App\Entity\User;
use App\Manager\ServiceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetServiceController extends AbstractController
{
    /** @var ServiceManager */
    private $serviceManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param ServiceManager $serviceManager
     * @param SerializerInterface $serializer
     */
    public function __construct(ServiceManager $serviceManager, SerializerInterface $serializer)
    {
        $this->serviceManager = $serviceManager;
        $this->serializer = $serializer;
    }

    /**
     * Get service by id
     *
     * @Route("/api/private/services/{id}", methods={"GET"})
     *
     * @OA\Tag(name="Services")
     *
     * @OA\Response(response=200, description="Service")
     * @OA\Response(response=400, description="The user should be administrator | The service was not found")
     *
     * @param UserInterface $user
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UserInterface $user, int $id): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator'], Response::HTTP_BAD_REQUEST);
        }

        $service = $this->serviceManager->findOneBy(['id' => $id]);
        if (is_null($service)) {
            return new JsonResponse(['error_message' => 'The service was not found'], Response::HTTP_BAD_REQUEST);
        }
        $normalizedService = $this->serializer->serialize($service, 'json');
        return new JsonResponse(json_decode($normalizedService, true), Response::HTTP_OK);
    }
}