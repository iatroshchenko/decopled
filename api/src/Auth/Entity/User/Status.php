<?php


namespace App\Auth\Entity\User;


class Status
{
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 0;

    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function wait(): self
    {
        return new self(self::STATUS_WAIT);
    }

    public static function active(): self
    {
        return new self(self::STATUS_ACTIVE);
    }

    public function isWait() :bool
    {
        return $this->value === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->value === self::STATUS_ACTIVE;
    }
}