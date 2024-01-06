<?php
namespace App\Controller;

use App\Entity\OpeningHours;
use App\Manager\OpeningHoursManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class DeleteOpeningHourController extends AbstractController
{
    /** @var OpeningHoursManager */
    private $openingHoursManager;

    /**
     * @param OpeningHoursManager $openingHoursManager
     */
    public function __construct(OpeningHoursManager $openingHoursManager) {
        $this->openingHoursManager = $openingHoursManager;
    }

    /**
     * Delete opening hour
     *
     * @Route("/api/opening/hour/{id}", methods={"DELETE"})
     *
     * @OA\Tag(name="Opening Hours")
     *
     * @OA\Response(response=200, description="Opening hour deleted")
     * @OA\Response(response=400, description="Error occurred")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        /** @var OpeningHours|null $openingHour */
        $openingHour = $this->openingHoursManager->findOneBy(['id' => $id]);
        if (empty($openingHour)) {
            return new JsonResponse(['error_message' => 'Opening hour not found'], Response::HTTP_BAD_REQUEST);
        }

        $this->openingHoursManager->delete($openingHour);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}