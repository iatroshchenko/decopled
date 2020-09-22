<?php


namespace App\Auth\Test\Unit\Entity\User;


use App\Auth\Entity\User\Email;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailTest
 * @package App\Auth\Test\Unit\Entity\User
 * @coversDefaultClass \App\Auth\Entity\User\Email
 */
class EmailTest extends TestCase
{
    /**
     * @covers ::getValue
     */
    public function testConstructor(): void
    {
        $email = new Email($value = 'my@mail.com');
        self::assertEquals($value, $email->getValue());
    }
}