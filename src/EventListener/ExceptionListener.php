<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Exception\InvalidEnquiryParametersException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $message = $exception->getMessage();

        $response = new JsonResponse();

        $response->setContent(json_encode([
            "errors" => $message
        ]));

        if ($exception instanceof InvalidEnquiryParametersException) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $event->setResponse($response);
    }
}
