<?php
namespace App\Controller;

use App\Manager\BrandManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetBrandsController extends AbstractController
{
    /** @var BrandManager */
    private $brandManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param BrandManager $brandManager
     * @param SerializerInterface $serializer
     */
    public function __construct(BrandManager $brandManager, SerializerInterface $serializer)
    {
        $this->brandManager = $brandManager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/brands", methods={"GET"})
     *
     * @OA\Tag(name="Brand")
     *
     * @OA\Response(response=200, description="Brands list")

     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $brands = $this->brandManager->findBy([], ['name' => 'ASC']);
        $normalizedList = $this->serializer->serialize($brands, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}