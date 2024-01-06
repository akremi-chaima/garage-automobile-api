<?php
namespace App\Controller;

use App\DTO\UpdateServiceDTO;
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

class UpdateServiceController extends AbstractController
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
     * Update service
     *
     * @Route("/api/service", methods={"PUT"})
     *
     * @OA\Tag(name="Services")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"id", "name", "isActive"},
     *              @OA\Property(property="id", type="integer"),
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="isActive", type="boolean"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="Service updated")
     * @OA\Response(response=400, description="Error occurred")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        /** @var UpdateServiceDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), UpdateServiceDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }

        /** @var Service|null $service */
        $service = $this->serviceManager->findOneBy(['id' => $dto->getId()]);
        if (empty($service)) {
            return new JsonResponse(['error_message' => 'Service not found'], Response::HTTP_BAD_REQUEST);
        }

        $service->setName($dto->getName())
            ->setActive($dto->getIsActive());

        $this->serviceManager->save($service);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}