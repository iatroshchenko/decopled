<?php


namespace App\Auth\Command\JoinByEmail\Request;

use App\Auth\Repository\UserRepository;
use App\Auth\Service\{Flusher, Tokenizer, JoinConfirmationSender, PasswordHasher};
use App\Auth\Entity\User\{Id, Email, User, Token};

class Handler
{
    private UserRepository $users;
    private Flusher $flusher;
    private JoinConfirmationSender $sender;
    private Tokenizer $tokenizer;
    private PasswordHasher $hasher;

    public function __construct(
        UserRepository $users,
        PasswordHasher $hasher,
        JoinConfirmationSender $sender,
        Tokenizer $tokenizer,
        Flusher $flusher
    )
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->sender = $sender;
        $this->tokenizer = $tokenizer;
        $this->flusher = $flusher;
    }

    public function __invoke(Command $command)
    {
        $email = new Email($command->email);
        $now = new \DateTimeImmutable();

        $user = new User(
            Id::generate(),
            $email,
            $this->hasher->hash($command->password),
            $now,
            $token = $this->tokenizer->generate($now)
        );

        $this->users->add($user);
        $this->flusher->flush();
        $this->sender->sendConfirmationLink($email, $token);
    }
}