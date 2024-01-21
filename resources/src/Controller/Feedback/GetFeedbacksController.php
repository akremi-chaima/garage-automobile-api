<?php
namespace App\Controller\Feedback;

use App\Entity\Status;
use App\Manager\FeedbackManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class GetFeedbacksController extends AbstractController
{
    /** @var FeedbackManager */
    private $feedbackManager;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param FeedbackManager $feedbackManager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        FeedbackManager $feedbackManager,
        SerializerInterface $serializer
    ) {
        $this->feedbackManager = $feedbackManager;
        $this->serializer = $serializer;
    }

    /**
     * Get feedbacks
     *
     * @Route("/api/feedbacks/{page}/{itemsPerPage}", methods={"GET"})
     *
     * @OA\Tag(name="Feedback")
     *
     * @OA\Response(response=200, description="Feedbacks list")
     *
     * @param int $page
     * @param int $itemsPerPage
     * @return JsonResponse
     */
    public function __invoke(int $page, int $itemsPerPage): JsonResponse
    {
        $feedbacksTotalNumber = $this->feedbackManager->count(['status' => Status::STATUS_CODE_VISIBLE]);
        $feedbacksPaginator = $this->feedbackManager->get(['status' => Status::STATUS_CODE_VISIBLE], $page, $itemsPerPage);
        $result = [
            'data' => json_decode($this->serializer->serialize($feedbacksPaginator->getItems(), 'json'), true),
            'currentPage' => $page,
            'totalItems' => $feedbacksTotalNumber,
        ];
        return new JsonResponse($result, Response::HTTP_OK);
    }
}