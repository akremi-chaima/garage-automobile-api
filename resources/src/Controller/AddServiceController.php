<?php
namespace App\Controller;

use App\DTO\AddServiceDTO;
use App\Entity\Service;
use App\Manager\ServiceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddServiceController extends AbstractController
{
    /** @var ServiceManager */
    private $serviceManager;

    /** @var SerializerInterface */
    private $serializer;

    /** @var ValidatorInterface */
    protected $validator;

    /**
     * @param ServiceManager $serviceManager
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        ServiceManager $serviceManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->serviceManager = $serviceManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Add service
     *
     * @Route("/api/service", methods={"POST"})
     *
     * @OA\Tag(name="Services")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"name", "isActive"},
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="isActive", type="boolean"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="Service saved")
     * @OA\Response(response=400, description="Error occurred")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        /** @var AddServiceDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), AddServiceDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }

        $service = (new Service())
            ->setName($dto->getName())
            ->setActive($dto->getIsActive());

        $this->serviceManager->save($service);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}