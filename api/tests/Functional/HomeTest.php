<?php

declare(strict_types=1);

namespace Test\Functional;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Factory\ServerRequestFactory;
use App\Help\Header;

class HomeTest extends TestCase {

    /** @coversNothing */
    public function testSuccess(): void
    {
        $response = $this->app()->handle(self::json('GET', '/'));

        self::assertEquals(Header::JSON, $response->getHeaderLine(Header::CONTENT_TYPE));
        self::assertEquals('{"hello":"world"}', (string)($response->getBody()));
        self::assertEquals(200, $response->getStatusCode());
    }

    private function app(): App
    {
        /** @var ContainerInterface $container */
        $container = require __DIR__ . '/../../config/container.php';

        /** @var App $app */
        $app = (require __DIR__ . '/../../config/app.php')($container);

        return $app;
    }


    private static function request(string $method, string $uri): ServerRequestInterface
    {
        return (new ServerRequestFactory())
            ->createServerRequest($method, $uri);
    }


    private static function json(string $method, string $uri): ServerRequestInterface
    {
        return self::request($method, $uri)
            ->withHeader('Content-Type', 'application/json');
    }
}