<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Psr\Http\Message\ResponseInterface;

class GetAllUsersController
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(): ResponseInterface
    {
        return json($this->userRepository->all());
    }
}