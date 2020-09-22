<?php

namespace App\Auth\Test\Unit\Service;

use App\Auth\Service\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Auth\Service\Tokenizer
 */
class TokenizerTest extends TestCase
{
    /**
     * @covers ::generate
     */
    public function testSuccess(): void
    {
        $interval = new \DateInterval('PT1H');
        $date = new \DateTimeImmutable('+1 day');

        $tokenizer = new Tokenizer($interval);
        $token = $tokenizer->generate($date);
        self::assertEquals($date->add($interval), $token->getExpireDate());
    }
}