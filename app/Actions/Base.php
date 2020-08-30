<?php

declare(strict_types=1);

namespace MoneyTransfer\Actions;

use MoneyTransfer\Library\RequestOutput;
use Exception;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use MoneyTransfer\Library\ResponseStatusCode;

abstract class Base
{
    protected ContainerInterface $container;
    protected Request $request;
    protected Response $response;
    protected array $args;
    private array $bodyContent;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @throws HttpNotFoundException
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        $status = true;
        $this->getBody();

        try {
            $data = $this->handle();
            $data = (empty($data)) ? null : $data;
        } catch (Exception $e) {
            $data = null;
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $payload = RequestOutput::output($data, $status);
        $response->getBody()->write(json_encode($payload));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(ResponseStatusCode::getStatusCode());
    }

    /**
     * Interpreta dados do body
     */
    private function getBody()
    {
        $contentType = $this->request->getHeaderLine('Content-Type');

        if (!strstr($contentType, 'application/json')) {
            return;
        }

        $contents = json_decode(file_get_contents('php://input'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return;
        }

        $request = $this->request->withParsedBody($contents);
        $this->bodyContent = $request->getParsedBody();
    }

    protected function getBodyContent(): array
    {
        return $this->bodyContent;
    }

    protected abstract function handle(): array;
}
