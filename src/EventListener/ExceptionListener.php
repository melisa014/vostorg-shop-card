<?php

namespace App\EventListener;

use InvalidArgumentException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use UnexpectedValueException;

class ExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     *
     * @throws InvalidArgumentException
     * @throws UnexpectedValueException
     */
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();
        $exceptionMessage = $exception->getMessage();

        $response = new Response();

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->setContent(
                json_encode(
                    [
                        'code' => $exception->getCode(),
                        'message' => $exceptionMessage,
                    ],
                    256 | 128
                )
            );

            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setContent(
                json_encode(
                    [
                        'code' => '00',
                        // TODO: нужно дописывать или не дописывать ошибку в зависимости от окружения
                         'message' => "Внутренняя ошибка сервера. $exceptionMessage",
//                        'message' => "Внутренняя ошибка сервера",
                    ],
                    256 | 128
                )
            );
        }

        $event->setResponse($response);
    }
}
