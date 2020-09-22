<?php


namespace App\Auth\Entity\User;


use Webmozart\Assert\Assert;

class Token
{
    private \DateTimeImmutable $expires;
    private string $value;

    public function __construct(string $token, \DateTimeImmutable $expires)
    {
        Assert::uuid($token);
        $this->value = $token;
        $this->expires = $expires;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getExpireDate(): \DateTimeImmutable
    {
        return $this->expires;
    }

}