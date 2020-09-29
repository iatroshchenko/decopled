<?php


namespace App\Auth\Command\JoinByEmail\Confirm;


use App\Auth\Repository\UserRepository;
use App\Auth\Service\Flusher;

class Handler
{
    private UserRepository $users;
    private Flusher $flusher;

    public function __construct(UserRepository $userRepository, Flusher $flusher)
    {
        $this->users = $userRepository;
        $this->flusher = $flusher;
    }

    public function __invoke(Command $command)
    {
        $user = $this->users->getByToken($command->token);
        $user->confirmJoin($command->token);
        $this->flusher->flush();
    }
}