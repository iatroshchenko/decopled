<?php


namespace App\Test\Unit\UseCase\JoinByEmail;


use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\Token;
use App\Auth\Entity\User\User;
use PHPUnit\Framework\TestCase;

/**
 * Class TestConfirm
 * @package App\Test\Unit\UseCase\JoinByEmail
 * @coversDefaultClass \App\Auth\Entity\User\User
 */
class ConfirmTest extends TestCase
{
    /**
     * @covers ::confirmJoin
     */
    public function testSuccess(): void
    {
        $user = new User(
            $id = Id::generate(),
            $email = new Email('mail@mail.com'),
            $hash = 'hash',
            $createdAt = new \DateTimeImmutable(),
            $token = Token::generate()
        );

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        $user->confirmJoin($token->getValue());

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());
        self::assertNull($user->getJoinConfirmationToken());
    }
}