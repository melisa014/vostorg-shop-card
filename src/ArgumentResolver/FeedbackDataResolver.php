<?php

namespace App\ArgumentResolver;

use App\DTO\FeedbackData;
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
     * @param FeedbackValidator $validator
     */
    public function __construct(FeedbackValidator $validator)
    {
        $this->validator = $validator;
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

        $errors = $this->validator->validate([
            'phone' => $phone,
            'message' => $message,
            'email' => $email,
            'name' => $name,
        ]);

        if (!empty($errors)) {
            throw new ValidationException(json_encode($errors, 128 | 256));
        }

        yield new FeedbackData(
            $phone,
            $message,
            $email,
            $name
        );
    }
}
