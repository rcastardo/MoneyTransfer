<?php

namespace MoneyTransfer\Middleware;

use MoneyTransfer\Library\RequestOutput;
use MoneyTransfer\Library\UtilsResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\ErrorHandler;
use Throwable;

class ErrorHandlerMiddleware extends ErrorHandler
{
    public function __invoke(
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ): ResponseInterface
    {
        $payload = RequestOutput::output();

        $response = $this->responseFactory->createResponse();
        $response->getBody()->write(
            json_encode($payload, JSON_UNESCAPED_UNICODE)
        );

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(UtilsResponse::getStatusCode());

    }
}
