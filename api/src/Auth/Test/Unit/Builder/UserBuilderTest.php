<?php


namespace App\Auth\Test\Builder;


use App\Auth\Entity\User\User;
use PHPUnit\Framework\TestCase;
use App\Auth\Builder\UserBuilder;

/**
 * @coversDefaultClass \App\Auth\Builder\UserBuilder
 */
class UserBuilderTest extends TestCase
{
    /**
     * @covers ::get
     */
    public function testDefault()
    {
        $user = (new UserBuilder())
            ->get();

        self::assertInstanceOf(User::class, $user);
        self::assertFalse($user->isActive());
        self::assertTrue($user->isWait());
    }

    /**
     * @covers ::get
     */
    public function testActive()
    {
        $user = (new UserBuilder())
            ->active()
            ->get();

        self::assertInstanceOf(User::class, $user);
        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());
    }
}