<?php


namespace App\Auth\Test\Unit\Service;


use App\Auth\Service\PasswordHasher;
use PHPUnit\Framework\TestCase;

/**
 * Class PasswordHasherTest
 * @package App\Auth\Test\Unit\Service
 * @coversDefaultClass \App\Auth\Service\PasswordHasher
 */
class PasswordHasherTest extends TestCase
{
    /**
     * @covers ::hash
     */
    public function test_if_hasher_changes_provided_input(): void
    {
        $hasher = new PasswordHasher();
        $hash = $hasher->hash($password = 'new-password');

        self::assertNotEmpty($hash);
        self::assertNotEquals($password, $hash);
    }

    /**
     * @covers ::hash
     */
    public function test_if_hasher_declines_empty_input(): void
    {
        $hasher = new PasswordHasher();
        self::expectException(\InvalidArgumentException::class);
        $hasher->hash('');
    }

    /**
     * @covers ::validate
     */
    public function test_if_hasher_can_validate_given_password(): void
    {
        $hasher = new PasswordHasher();
        $hash = $hasher->hash($password = 'password');
        self::assertTrue($hasher->validate($password, $hash));
        self::assertFalse($hasher->validate('new-password', $hash));
    }
}