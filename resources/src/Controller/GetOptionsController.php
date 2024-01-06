<?php
namespace App\Controller;

use App\Manager\OptionsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetOptionsController extends AbstractController
{
    /** @var OptionsManager */
    private $optionsManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param OptionsManager $optionsManager
     * @param SerializerInterface $serializer
     */
    public function __construct(OptionsManager $optionsManager, SerializerInterface $serializer)
    {
        $this->optionsManager = $optionsManager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/options", methods={"GET"})
     *
     * @OA\Tag(name="Options")
     *
     * @OA\Response(response=200, description="Options list")

     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $options = $this->optionsManager->findAll();
        $normalizedList = $this->serializer->serialize($options, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}