<?php
namespace App\Controller\Picture;

use App\Entity\Picture;
use App\Entity\User;
use App\Manager\PictureManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @Route("/api/private/picture/{id}", methods={"DELETE"})
     *
     * @OA\Tag(name="Pictures")
     *
     * @OA\Response(response=200, description="Picture deleted")
     * @OA\Response(response=400, description="The user should be administrator or employee | The picture is not found")
     *
     * @param UserInterface $user
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UserInterface $user, int $id): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles()) && !in_array(User::ROLE_EMPLOYEE, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator or employee'], Response::HTTP_BAD_REQUEST);
        }

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