<?php
namespace App\Controller\Model;

use App\Manager\ModelManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetModelsController extends AbstractController
{
    /** @var ModelManager */
    private $modelManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param ModelManager $modelManager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ModelManager $modelManager,
        SerializerInterface $serializer
    ) {
        $this->modelManager = $modelManager;
        $this->serializer = $serializer;
    }

    /**
     * Get models list
     *
     * @Route("/api/models", methods={"GET"})
     *
     * @OA\Tag(name="Model")
     *
     * @OA\Response(response=200, description="Models list")
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $models = $this->modelManager->findBy([], ['name' => 'ASC']);
        $normalizedList = $this->serializer->serialize($models, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}