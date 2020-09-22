<?php


namespace App\Auth\Entity\User;

use Webmozart\Assert\Assert;

class Email
{
    private string $email;

    public function __construct(string $value)
    {
        Assert::email($value);
        $this->email = $value;
    }

    public function getValue()
    {
        return $this->email;
    }
}