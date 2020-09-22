<?php

namespace App\Auth\Test\Unit\Entity\User;

use App\Auth\Entity\User\Token;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Class TokenTest
 * @package App\Auth\Test\Unit\Entity\User
 * @coversDefaultClass \App\Auth\Entity\User\Token
 */
class TokenTest extends TestCase
{
    /**
     * @covers ::getValue
     */
    public function testConstruct()
    {
        $expires = new \DateTimeImmutable('+1 hour');
        $token = new Token($value = Uuid::uuid4()->toString(), $expires);
        self::assertEquals($value, $token->getValue());
    }
}
