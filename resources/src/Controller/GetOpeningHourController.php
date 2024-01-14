<?php
namespace App\Controller;

use App\Entity\OpeningHours;
use App\Entity\User;
use App\Manager\OpeningHoursManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetOpeningHourController extends AbstractController
{
    /** @var OpeningHoursManager */
    private $openingHoursManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param OpeningHoursManager $openingHoursManager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        OpeningHoursManager $openingHoursManager,
        SerializerInterface $serializer
    ) {
        $this->openingHoursManager = $openingHoursManager;
        $this->serializer = $serializer;
    }

    /**
     * Get opening hour by id
     *
     * @Route("/api/private/opening/hour/{id}", methods={"GET"})
     *
     * @OA\Tag(name="Opening Hours")
     *
     * @OA\Response(response=200, description="Opening hour")
     * @OA\Response(response=400, description="The user should be administrator | The opening hour is not found")
     *
     * @param UserInterface $user
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UserInterface $user, int $id): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator.'], Response::HTTP_BAD_REQUEST);
        }

        /** @var OpeningHours|null $openingHour */
        $openingHour = $this->openingHoursManager->findOneBy(['id' => $id]);
        if (empty($openingHour)) {
            return new JsonResponse(['error_message' => 'The opening hour is not found'], Response::HTTP_BAD_REQUEST);
        }

        $normalizedOpeningHour = $this->serializer->serialize($openingHour, 'json');
        return new JsonResponse(json_decode($normalizedOpeningHour, true), Response::HTTP_OK);
    }
}