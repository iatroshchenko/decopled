<?php


namespace App\Auth\Command\JoinByEmail\Request;


class Command
{
    public string $email;
    public string $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}