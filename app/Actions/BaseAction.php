<?php

declare(strict_types=1);

namespace MoneyTransfer\Actions;

use MoneyTransfer\Library\{
    RequestOutput,
    UtilsResponse,
};
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

abstract class BaseAction
{
    protected Request $request;
    protected Response $response;
    protected array $args;
    protected $body;
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     * @throws HttpNotFoundException
     */
    public function __invoke(Request $request, Response $response, $args): Response
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
            ->withStatus(UtilsResponse::getStatusCode());
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
        $this->body = $request->getParsedBody();
    }

    protected abstract function handle(): array;
}