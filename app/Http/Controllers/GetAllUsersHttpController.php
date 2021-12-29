<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class GetAllUsersHttpController
{
    public function __construct(private UserRepository $userRepository, private LoggerInterface $logger)
    {
    }

    public function __invoke(): ResponseInterface
    {
        $users = $this->userRepository->all();
        $this->logger->debug('users controller', $users);

        return json([
            'users' => $users,
        ]);
    }
}