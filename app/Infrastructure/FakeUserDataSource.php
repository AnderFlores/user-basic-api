<?php

namespace App\Infrastructure\Providers;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataSource implements UserDataSource
{


    public function findByEmail(string $email): User
    {
        return new User(1, "user@user.com");
    }
}
