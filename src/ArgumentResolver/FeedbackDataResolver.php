<?php

namespace App\ArgumentResolver;

use App\DTO\FeedbackData;
use App\Exception\ValidationException;
use App\Service\ReCaptcha;
use App\Validation\FeedbackValidator;
use Exception;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class FeedbackDataResolver implements ArgumentValueResolverInterface
{
    /**
     * @var FeedbackValidator
     */
    private $validator;

    /**
     * @var string
     */
    private $recapchaKey;

    /**
     * @param FeedbackValidator $validator
     * @param string            $recapchaKey
     */
    public function __construct(FeedbackValidator $validator, string $recapchaKey)
    {
        $this->validator = $validator;
        $this->recapchaKey = $recapchaKey;
    }

    /**
     * @param Request          $request
     * @param ArgumentMetadata $argument
     *
     * @return bool
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return FeedbackData::class === $argument->getType();
    }

    /**
     * @param Request          $request
     * @param ArgumentMetadata $argument
     *
     * @return Generator
     *
     * @throws Exception
     */
    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $phone = $request->get('phone');
        $message = $request->get('message');
        $email = $request->get('email');
        $name = $request->get('name');
        $recapcha = $request->get('g-recaptcha-response');

        $errors = $this->validator->validate([
            'phone' => $phone,
            'message' => $message,
            'email' => $email,
            'name' => $name,
            'recapcha' => $recapcha,
        ]);

        // TODO: Сделать шаблон для вывода ошибок пользователю и обработчик эксепшенов с шаблоном
        if (!empty($errors)) {
            throw new ValidationException(json_encode($errors, 128 | 256));
        }

        $reCaptchaService = new ReCaptcha($this->recapchaKey);

        $capchaVerifyServiceResponse = $reCaptchaService->verifyResponse(
            $request->server->get('REMOTE_ADDR'),
            $recapcha
        ) ?? null;

        if (!empty($capchaVerifyServiceResponse) && !$capchaVerifyServiceResponse->success) {
            throw new ValidationException("Вы не прошли проверку на спам. $capchaVerifyServiceResponse->errorCodes");
        }

        yield new FeedbackData(
            $phone,
            $message,
            $email,
            $name
        );
    }
}
