<?php


namespace App\Auth\Entity\User;


class User
{
    private Id $id;
    private Email $email;
    private string $password;
    private \DateTimeImmutable $createdAt;
    private ?Token $joinConfirmationToken;
    private Status $status;

    public function __construct(
        Id $id,
        Email $email,
        string $password,
        \DateTimeImmutable $createdAt,
        Token $joinConfirmationToken
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->joinConfirmationToken = $joinConfirmationToken;
        $this->status = Status::wait();
    }

    public function isActive(): bool
    {
        return $this->status->isActive();
    }

    public function isWait(): bool
    {
        return $this->status->isWait();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getJoinConfirmationToken(): ?Token
    {
        return $this->joinConfirmationToken;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function confirmJoin(string $token)
    {
        $this->getJoinConfirmationToken()->validate($token);
        $this->status = Status::active();
        $this->joinConfirmationToken = null;
    }

}