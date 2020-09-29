<?php


namespace App\Auth\Command\JoinByEmail\Confirm;


class Command
{
    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }
}