<?php
namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Vehicle;
use App\Manager\PictureManager;
use App\Manager\VehicleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AddPictureController extends AbstractController
{
    /** @var VehicleManager */
    private $vehicleManager;

    /** @var PictureManager */
    private $pictureManager;

    /**
     * @param VehicleManager $vehicleManager
     * @param PictureManager $pictureManager
     */
    public function __construct(VehicleManager $vehicleManager, PictureManager $pictureManager) {
        $this->vehicleManager = $vehicleManager;
        $this->pictureManager = $pictureManager;
    }

    /**
     * Add picture
     *
     * @Route("/api/picture/{vehicleId}", methods={"POST"})
     *
     * @OA\Tag(name="Pictures")
     *
     * @OA\Response(response=200, description="Picture saved")
     * @OA\Response(response=400, description="Error occurred")
     *
     * @param Request $request
     * @param int $vehicleId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $vehicleId): JsonResponse
    {
        /** @var UploadedFile|null $file */
        $file = $request->files->get('file');
        if (is_null($file) ) {
            return new JsonResponse(['error_message' => 'The files should not be empty'], Response::HTTP_BAD_REQUEST);
        }

        /** @var Vehicle|null $vehicle */
        $vehicle = $this->vehicleManager->findOneBy(['id' => $vehicleId]);
        if (empty($vehicle)) {
            return new JsonResponse(['error_message' => 'Vehicle not found'], Response::HTTP_BAD_REQUEST);
        }

        $picture = (new Picture())
            ->setName($file->getClientOriginalName())
            ->setVehicle($vehicle);

        $this->pictureManager->save($picture);

        $destination = $this->getParameter('kernel.project_dir').'/public/uploads/'.$vehicleId.'/'.$picture->getId();
        $file->move($destination, $file->getClientOriginalName());

        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}