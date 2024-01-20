<?php
namespace App\Controller;

use App\DTO\UpdateUserDTO;
use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
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
     * @Route("/api/private/user", methods={"PUT"})
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
     * @OA\Response(response=400, description="The user should be administrator | The email is already used | The user not found")
     *
     * @param Request $request
     * @param UserInterface $user
     * @return JsonResponse
     */
    public function __invoke(Request $request, UserInterface $user): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator'], Response::HTTP_BAD_REQUEST);
        }

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
        /** @var User|null $userByEmail */
        $userByEmail = $this->userManager->findOneBy(['email' => $dto->getEmail()]);
        if (!is_null($userByEmail) && $userByEmail->getId() !== $dto->getId()) {
            return new JsonResponse(['error_message' => 'The email is already used'], Response::HTTP_BAD_REQUEST);
        }

        // get user to update
        /** @var User|null $userById */
        $userById = $this->userManager->findOneBy(['id' => $dto->getId()]);
        if (is_null($userById)) {
            return new JsonResponse(['error_message' => 'The user not found'], Response::HTTP_BAD_REQUEST);
        }

        $userById->setLastname($dto->getLastname())
            ->setFirstname($dto->getFirstname())
            ->setUsername($dto->getEmail())
            ->setRoles($dto->getRole())
            ->setActive($dto->getIsActive());

        $this->userManager->save($userById);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}