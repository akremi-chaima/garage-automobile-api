<?php
namespace App\Controller;

use App\Entity\Service;
use App\Manager\ServiceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class DeleteServiceController extends AbstractController
{
    /** @var ServiceManager */
    private $serviceManager;

    /**
     * @param ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
    }

    /**
     * Delete service
     *
     * @Route("/api/service/{id}", methods={"DELETE"})
     *
     * @OA\Tag(name="Services")
     *
     * @OA\Response(response=200, description="Service deleted")
     * @OA\Response(response=400, description="Error occurred")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        /** @var Service|null $service */
        $service = $this->serviceManager->findOneBy(['id' => $id]);
        if (empty($service)) {
            return new JsonResponse(['error_message' => 'Service not found'], Response::HTTP_BAD_REQUEST);
        }

        $this->serviceManager->delete($service);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}