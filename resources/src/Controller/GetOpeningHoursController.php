<?php
namespace App\Controller;

use App\Manager\OpeningHoursManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetOpeningHoursController extends AbstractController
{
    /** @var OpeningHoursManager */
    private $openingHoursManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param OpeningHoursManager $openingHoursManager
     * @param SerializerInterface $serializer
     */
    public function __construct(OpeningHoursManager $openingHoursManager, SerializerInterface $serializer)
    {
        $this->openingHoursManager = $openingHoursManager;
        $this->serializer = $serializer;
    }

    /**
     * Get opening hours list
     *
     * @Route("/api/opening/hours", methods={"GET"})
     *
     * @OA\Tag(name="Opening Hours")
     *
     * @OA\Response(response=200, description="Opening hours list")

     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $openingHours = $this->openingHoursManager->findAll();
        $normalizedList = $this->serializer->serialize($openingHours, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}