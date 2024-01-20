<?php
namespace App\Controller;

use App\DTO\ContactDTO;
use App\Security\JwtUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var ValidatorInterface */
    protected $validator;

    /** @var JwtUtil */
    protected $jwtUtil;

    /**
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param JwtUtil $jwtUtil
     */
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        JwtUtil $jwtUtil
    ) {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->jwtUtil = $jwtUtil;
    }

    /**
     * Send contact email
     *
     * @Route("/api/contact", methods={"POST"})
     *
     * @OA\Tag(name="Contact")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              required={"subject", "lastName", "firstName", "email", "message", "phoneNumber", "address", "zipCode", "city"},
     *              @OA\Property(property="subject", type="string"),
     *              @OA\Property(property="lastName", type="string"),
     *              @OA\Property(property="firstName", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(property="phoneNumber", type="string"),
     *              @OA\Property(property="address", type="string"),
     *              @OA\Property(property="zipCode", type="string"),
     *              @OA\Property(property="city", type="string"),
     *          )
     *      )
     * )
     *
     * @OA\Response(response=200, description="Email send")
     * @OA\Response(response=400, description="Invalid data")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request, MailerInterface $mailer): JsonResponse
    {
        /** @var ContactDTO $dto */
        $dto = $this->serializer->deserialize($request->getContent(), ContactDTO::class, 'json');

        $errors = $this->validator->validate($dto);

        if ($errors->count()) {
            $display = [];
            foreach ($errors as $error) {
                $display[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['error_messages' => $display], Response::HTTP_BAD_REQUEST);
        }

        $email = (new Email())
            ->to(getenv('CONTACT_MAIL'))
            ->subject($dto->getSubject())
            ->from(getenv('CONTACT_MAIL'))
            ->html('
                <div>Nom: '.$dto->getLastName().'</div>
                <div>Prénom: '.$dto->getFirstName().'</div>
                <div>Email: '.$dto->getEmail().'</div>
                <div>Téléphone: '.$dto->getPhoneNumber().'</div>
                <div>Adresse: '.nl2br($dto->getAddress()).'</div>
                <div>Ville: '.$dto->getCity().'</div>
                <div>Code postal: '.$dto->getZipCode().'</div>
                <div>Message: '.$dto->getMessage().'</div>
            ');

        $mailer->send($email);
        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}