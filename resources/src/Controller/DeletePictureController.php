<?php
namespace App\Controller;

use App\Entity\Picture;
use App\Manager\PictureManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class DeletePictureController extends AbstractController
{
    /** @var PictureManager */
    private $pictureManager;

    /**
     * @param PictureManager $pictureManager
     */
    public function __construct(PictureManager $pictureManager) {
        $this->pictureManager = $pictureManager;
    }

    /**
     * Delete picture
     *
     * @Route("/api/picture/{id}", methods={"DELETE"})
     *
     * @OA\Tag(name="Pictures")
     *
     * @OA\Response(response=200, description="Picture deleted")
     * @OA\Response(response=400, description="Error occurred")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        /** @var Picture|null $picture */
        $picture = $this->pictureManager->findOneBy(['id' => $id]);
        if (empty($picture)) {
            return new JsonResponse(['error_message' => 'The picture is not found'], Response::HTTP_BAD_REQUEST);
        }

        $directory = $this->getParameter('kernel.project_dir').'/public/uploads/'.$picture->getVehicle()->getId().'/'.$picture->getId();
        // delete picture
        unlink($directory.'/'.$picture->getName());

        // delete folder
        rmdir($directory);

        $this->pictureManager->delete($picture);

        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}