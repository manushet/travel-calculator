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

        $response = new JsonResponse();



        if ($exception instanceof InvalidEnquiryParametersException) {
            $message = $exception->getMessage();

            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        } else {
            $message = "An internal error occured.";

            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response->setContent(json_encode([
            "errors" => $message
        ]));

        $event->setResponse($response);
    }
}
