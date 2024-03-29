<?php
namespace App\Controller\Gearbox;

use App\Manager\GearboxManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetGearboxesController extends AbstractController
{
    /** @var GearboxManager */
    private $gearboxManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param GearboxManager $gearboxManager
     * @param SerializerInterface $serializer
     */
    public function __construct(GearboxManager $gearboxManager, SerializerInterface $serializer)
    {
        $this->gearboxManager = $gearboxManager;
        $this->serializer = $serializer;
    }

    /**
     * Get gearboxes list
     *
     * @Route("/api/gearboxes", methods={"GET"})
     *
     * @OA\Tag(name="Gearbox")
     *
     * @OA\Response(response=200, description="Gearboxes list")
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $gearboxes = $this->gearboxManager->findBy([], ['name' => 'ASC']);
        $normalizedList = $this->serializer->serialize($gearboxes, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}