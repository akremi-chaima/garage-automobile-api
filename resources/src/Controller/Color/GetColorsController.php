<?php
namespace App\Controller\Color;

use App\Manager\ColorManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetColorsController extends AbstractController
{
    /** @var ColorManager */
    private $colorManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param ColorManager $colorManager
     * @param SerializerInterface $serializer
     */
    public function __construct(ColorManager $colorManager, SerializerInterface $serializer)
    {
        $this->colorManager = $colorManager;
        $this->serializer = $serializer;
    }

    /**
     * Get colors list
     *
     * @Route("/api/colors", methods={"GET"})
     *
     * @OA\Tag(name="Color")
     *
     * @OA\Response(response=200, description="Colors list")
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $colors = $this->colorManager->findAll();
        $normalizedList = $this->serializer->serialize($colors, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}