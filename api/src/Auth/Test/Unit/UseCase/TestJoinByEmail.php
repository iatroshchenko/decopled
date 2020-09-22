<?php

namespace App\Auth\Test\Unit\UseCase;

use App\Auth\Entity\User\{Email, Id, Token, User};
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class TestJoinByEmail extends TestCase
{
    public function testSuccess()
    {
        $now = new \DateTimeImmutable();

        $user = new User(
            $id = Id::generate(), // uuid,
            $email = new Email('email@mail.com'),
            $hash = 'hash',
            $date = $now, // created_at
            $token = new Token(Uuid::uuid4(), $now)
        );

        self::assertEquals($id, $user->getId());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($hash, $user->getPasswordHash());
        self::assertEquals($date, $user->getDate());
        self::assertEquals($token, $user->getJoinConfirmToken());
    }
}