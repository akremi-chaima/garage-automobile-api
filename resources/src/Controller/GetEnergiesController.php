<?php
namespace App\Controller;

use App\Manager\EnergyManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetEnergiesController extends AbstractController
{
    /** @var EnergyManager */
    private $energyManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param EnergyManager $energyManager
     * @param SerializerInterface $serializer
     */
    public function __construct(EnergyManager $energyManager, SerializerInterface $serializer)
    {
        $this->energyManager = $energyManager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/energies", methods={"GET"})
     *
     * @OA\Tag(name="Energy")
     *
     * @OA\Response(response=200, description="Energies list")

     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $energies = $this->energyManager->findBy([], ['name' => 'ASC']);
        $normalizedList = $this->serializer->serialize($energies, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}