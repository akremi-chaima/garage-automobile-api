<?php
namespace App\Controller;

use App\DTO\AddUserDTO;
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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AddUserController extends AbstractController
{
    /** @var UserManager */
    private $userManager;

    /** @var SerializerInterface */
    private $serializer;

    /** @var ValidatorInterface */
    protected $validator;

    /** @var UserPasswordHasherInterface */
    private $userPasswordHasherInterface;


    /**
     * @param UserManager $userManager
     * @param UserPasswordHasherInterface $userPasswordHasherInterface
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        UserManager $userManager,
        UserPasswordHasherInterface $userPasswordHasherInterface,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->userManager = $userManager;
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Add user
     *
     * @Route("/api/private/user", methods={"POST"})
     *
     * @OA\Tag(name="Users")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"firstname", "lastname", "email", "password", "role", "isActive"},
     *              @OA\Property(property="firstname", type="string"),
     *              @OA\Property(property="lastname", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="role", type="string", description="administrator or employee"),
     *              @OA\Property(property="isActive", type="boolean"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="User saved")
     * @OA\Response(response=400, description="The user should be administrator | The email is already used")
     *
     * @param Request $request
     * @param UserInterface $user
     * @return JsonResponse
     */
    public function __invoke(Request $request, UserInterface $user): JsonResponse
    {
        if (!in_array(User::ROLE_ADMINISTRATOR, $user->getRoles())) {
            return new JsonResponse(['error_message' => 'The user should be administrator.'], Response::HTTP_BAD_REQUEST);
        }

        /** @var AddUserDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), AddUserDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }

        // check used email
        $user = $this->userManager->findOneBy(['email' => $dto->getEmail()]);
        if (!is_null($user)) {
            return new JsonResponse(['error_message' => 'The email is already used'], Response::HTTP_BAD_REQUEST);
        }

        $user = (new User())
            ->setLastname($dto->getLastname())
            ->setFirstname($dto->getFirstname())
            ->setUsername($dto->getEmail())
            ->setRoles($dto->getRole())
            ->setActive($dto->getIsActive());

        // hash user password
        $user->setPassword($this->userPasswordHasherInterface->hashPassword($user, hash('sha256', $dto->getPassword())));

        $this->userManager->save($user);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}