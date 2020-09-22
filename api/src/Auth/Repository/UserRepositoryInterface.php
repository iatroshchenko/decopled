<?php


namespace App\Auth\Repository;


use App\Auth\Entity\User\{User, Email};

interface UserRepositoryInterface
{
    public function hasByEmail(Email $email): bool;
    public function add(User $user): void;
}