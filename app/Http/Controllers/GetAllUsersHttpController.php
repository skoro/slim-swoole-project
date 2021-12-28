<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Psr\Http\Message\ResponseInterface;

class GetAllUsersHttpController
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(): ResponseInterface
    {
        return json([
            'users' => $this->userRepository->all(),
        ]);
    }
}