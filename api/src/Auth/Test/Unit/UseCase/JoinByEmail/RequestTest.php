<?php


namespace App\Test\Unit\UseCase\JoinByEmail;

use App\Auth\Entity\User\{Email, Id, Token, User};
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Class RequestTest
 * @package App\Test\Unit\UseCase\JoinByEmail
 * @coversDefaultClass \App\Auth\Entity\User\User
 */
class RequestTest extends TestCase
{
    /**
     * @covers ::getId ::getEmail ::getPasswordHash ::getCreatedAt ::getJoinConfirmationToken ::isWait ::isActive
     */
    public function testSuccess()
    {
        $now = new \DateTimeImmutable();

        $user = new User(
            $id = Id::generate(), // uuid,
            $email = new Email('email@mail.com'),
            $hash = 'hash',
            $createdAt = $now, // created_at
            $token = new Token(Uuid::uuid4(), $now)
        );

        self::assertEquals($id, $user->getId());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($hash, $user->getPasswordHash());
        self::assertEquals($createdAt, $user->getCreatedAt());
        self::assertEquals($token, $user->getJoinConfirmationToken());
        self::assertEquals(true, $user->isWait());
        self::assertEquals(false, $user->isActive());
    }
}