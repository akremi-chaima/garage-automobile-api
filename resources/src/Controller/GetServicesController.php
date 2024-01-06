<?php
namespace App\Controller;

use App\Manager\ServiceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetServicesController extends AbstractController
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
     * Get services list
     *
     * @Route("/api/services", methods={"GET"})
     *
     * @OA\Tag(name="Services")
     *
     * @OA\Response(response=200, description="Services list")
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $services = $this->serviceManager->findAll();
        $normalizedList = $this->serializer->serialize($services, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}