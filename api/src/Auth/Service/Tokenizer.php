<?php

namespace App\Auth\Service;
use App\Auth\Entity\User\Token;
use Ramsey\Uuid\Uuid;

class Tokenizer
{
    private ?\DateInterval $interval;

    public function __construct(\DateInterval $interval = null)
    {
        $this->interval = $interval;
    }

    public function generate(\DateTimeImmutable $expires): Token
    {
        if (!is_null($this->interval)) {
            $expires = $expires->add($this->interval);
        }
        return new Token(Uuid::uuid4()->toString(), $expires);
    }
}