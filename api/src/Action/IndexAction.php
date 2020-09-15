<?php


namespace App\Action;


use App\Http;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class IndexAction implements RequestHandlerInterface
{
    private ResponseFactoryInterface $factory;

    public function __construct(ResponseFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->factory->createResponse();
        return Http::json($response, new \stdClass());
    }
}