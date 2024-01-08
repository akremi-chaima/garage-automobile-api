<?php
namespace App\Controller;

use App\DTO\FilterModelsDTO;
use App\Entity\Brand;
use App\Manager\BrandManager;
use App\Manager\ModelManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GetModelsController extends AbstractController
{
    /** @var ModelManager */
    private $modelManager;

    /** @var BrandManager */
    private $brandManager;

    /** @var SerializerInterface */
    private $serializer;

    /** @var ValidatorInterface */
    protected $validator;

    /**
     * @param ModelManager $modelManager
     * @param BrandManager $brandManager
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        ModelManager $modelManager,
        BrandManager $brandManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->brandManager = $brandManager;
        $this->modelManager = $modelManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Get models list
     *
     * @Route("/api/models", methods={"POST"})
     *
     * @OA\Tag(name="Model")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              @OA\Property(property="brandId", type="integer"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="Models list")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        /** @var FilterModelsDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), FilterModelsDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }
        $filter = [];

        if (!empty($dto->getBrandId())) {
            /** @var Brand|null $brand */
            $brand = $this->brandManager->findOneBy(['id' => $dto->getBrandId()]);
            if (empty($brand)) {
                return new JsonResponse(['error_message' => 'The brand is not found'], Response::HTTP_BAD_REQUEST);
            }
            $filter = ['brand' => $brand];
        }

        $models = $this->modelManager->findBy($filter, ['name' => 'ASC']);
        $normalizedList = $this->serializer->serialize($models, 'json');
        return new JsonResponse(json_decode($normalizedList, true), Response::HTTP_OK);
    }
}