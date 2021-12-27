<?php

namespace App\Repositories;

use App\Entities\User;

class ArrayUserRepository implements UserRepository
{

    public function all(): array
    {
        return [
            new User(1, 'admin', 'admin@your-domain.com', true),
            new User(2, 'editor', 'editor@your-domain.com', true),
            new User(3, 'guest', 'guest@your-domain.com', true),
            new User(4, 'banned', 'banned@your-domain.com', false),
        ];
    }
}