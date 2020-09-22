<?php

namespace App\Auth\Test\Unit\Entity\User;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;
use App\Auth\Entity\User\Id;

/**
 * Class IdTest
 * @package App\Auth\Test\Unit\Entity\User
 * @coversDefaultClass \App\Auth\Entity\User\Id
 */
class IdTest extends TestCase
{
    /**
     * @covers ::getValue
     */
    public function testConstructor(): void
    {
        $id = new Id($value = Uuid::uuid4()->toString());
        self::assertEquals($value, $id->getValue());
    }

    /**
     * @covers ::generate
     * @covers ::getValue
     */
    public function testGenerate(): void
    {
        $id = Id::generate();
        Assert::uuid($id->getValue());
        self::addToAssertionCount(1);
    }
}