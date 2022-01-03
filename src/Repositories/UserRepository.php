<?php

namespace App\Repositories;

use App\Entities\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function all(): array;
}