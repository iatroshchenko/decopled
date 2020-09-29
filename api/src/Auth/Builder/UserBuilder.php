<?php


namespace App\Auth\Builder;


use App\Auth\Entity\User\{Id, Email, Token, User};
use DateTimeImmutable;

class UserBuilder
{
    private Id $id;
    private Email $email;
    private Token $joinConfirmToken;
    private DateTimeImmutable $createdAt;
    private bool $active = false;
    private string $hash;

    public function __construct(Id $id = null, Email $mail = null, Token $token = null, DateTimeImmutable $createdAt = null, bool $active = false)
    {
        if (is_null($id)) $id = Id::generate();
        $this->id = $id;

        $this->email = new Email('my@mail.com');

        if (is_null($token)) $token = Token::generate();
        $this->joinConfirmToken = $token;

        $this->hash = 'hash';
        $this->createdAt = new DateTimeImmutable();
        $this->active = $active;
    }

    public function active(): self
    {
        $clone = clone $this;
        $clone->active = true;
        return $clone;
    }

    public function withHash(string $hash)
    {
        $this->hash = $hash;
    }

    public function withEmail(string $email)
    {
        $email = new Email($email);
        $this->email = $email;
    }

    public function withJoinConfirmToken(string $token, DateTimeImmutable $expires = null)
    {
        $token = Token::generate();
        $this->joinConfirmToken = $token;
    }

    public function get(): User
    {
        $user = new User(
            $this->id,
            $this->email,
            $this->hash,
            $this->createdAt,
            $this->joinConfirmToken
        );

        if ($this->active) {
            $user->confirmJoin($this->joinConfirmToken);
        }

        return $user;
    }
}