<?php


namespace App\Auth\Repository;


use App\Auth\Entity\User\{User, Email};

interface UserRepository
{
    public function hasByEmail(Email $email): bool;
    public function add(User $user): void;
    public function getByToken(string $token): User;
    public function findByToken(string $token): ?User;
}