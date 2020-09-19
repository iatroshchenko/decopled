<?php

declare(strict_types=1);

namespace Test\Unit\Http;

use App\Http\JsonResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class JsonResponseTest
 * @package Test\Unit\Http
 * @coversDefaultClass  \App\Http\JsonResponse
 */
class JsonResponseTest extends TestCase
{
    public function getCases(): array
    {
        return [
            'null' => [null, 'null'],
            'number' => [2, '2'],
            'empty' => ['', '""'],
            'string' => ['docker', '"docker"']
        ];
    }

    /**
     * @param $source
     * @param $expect
     * @throws \JsonException
     * @dataProvider getCases
     * @covers ::getBody
     * @covers ::getStatusCode
     */
    public function testResponse($source, $expect): void
    {
        $response = new JsonResponse($source);

        self::assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        self::assertEquals($expect, $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
    }
}