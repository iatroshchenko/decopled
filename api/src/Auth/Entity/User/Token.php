<?php


namespace App\Auth\Entity\User;


use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class Token
{
    public const DEFAULT_TOKEN_TTL = '+1 day';

    private \DateTimeImmutable $expires;
    private string $value;

    public function __construct(string $token, \DateTimeImmutable $expires = null)
    {
        Assert::uuid($token);
        $this->value = $token;
        if (!$expires) $expires = (new \DateTimeImmutable())->modify(self::DEFAULT_TOKEN_TTL);
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

    public static function generate(\DateTimeImmutable $expires = null): self
    {
        return new self(Uuid::uuid4()->toString(), $expires);
    }

    public function validate(string $token, $date = null)
    {
        if (is_null($date)) $date = new \DateTimeImmutable();

        if ($this->value !== $token) {
            throw new \DomainException("Invalid token");
        }

        if ($date >= $this->getExpireDate()) {
            throw new \DomainException("Token expired");
        }
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

}