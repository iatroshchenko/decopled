<?php


namespace App\Auth\Entity\User;


class User
{
    private Id $id;
    private Email $email;
    private string $password;
    private \DateTimeImmutable $date;
    private Token $token;

    public function __construct(
        Id $id,
        Email $email,
        string $password,
        \DateTimeImmutable $date,
        Token $token
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->date = $date;
        $this->token = $token;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPasswordHash()
    {
        return $this->password;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getJoinConfirmToken()
    {
        return $this->token;
    }
}