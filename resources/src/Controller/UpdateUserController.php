<?php
namespace App\Controller;

use App\DTO\UpdateUserDTO;
use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateUserController extends AbstractController
{
    /** @var UserManager */
    private $userManager;

    /** @var SerializerInterface */
    private $serializer;

    /** @var ValidatorInterface */
    protected $validator;

    /**
     * @param UserManager $userManager
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        UserManager $userManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->userManager = $userManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Update user
     *
     * @Route("/api/user", methods={"PUT"})
     *
     * @OA\Tag(name="Users")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"id", "firstname", "lastname", "email", "role", "isActive"},
     *              @OA\Property(property="id", type="integer"),
     *              @OA\Property(property="firstname", type="string"),
     *              @OA\Property(property="lastname", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="role", type="string", description="administrator or employee"),
     *              @OA\Property(property="isActive", type="boolean"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="User updated")
     * @OA\Response(response=400, description="Error occurred")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        /** @var UpdateUserDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), UpdateUserDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }

        // check used email
        /** @var User $user */
        $user = $this->userManager->findOneBy(['email' => $dto->getEmail()]);
        if (!is_null($user) && $user->getId() !== $dto->getId()) {
            return new JsonResponse(['error_message' => 'The email is already used'], Response::HTTP_BAD_REQUEST);
        }

        $user->setLastname($dto->getLastname())
            ->setFirstname($dto->getFirstname())
            ->setUsername($dto->getEmail())
            ->setRoles($dto->getRole())
            ->setActive($dto->getIsActive());

        $this->userManager->save($user);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}