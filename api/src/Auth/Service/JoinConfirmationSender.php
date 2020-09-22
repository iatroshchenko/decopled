<?php


namespace App\Auth\Service;


use App\Auth\Entity\User\{Email, Token};

interface JoinConfirmationSender
{
    public function sendConfirmationLink(Email $email, Token $token): void;
}