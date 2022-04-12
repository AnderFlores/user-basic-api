<?php

namespace Tests\Doubles;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataSource implements UserDataSource
{
    private $users;
    public function findByEmail(string $email): User
    {
        return new User(1, $email);
    }

    public function findById(string $id): User
    {
        return new User($id, "user@user.com");
    }

    public function setUserList(array $users)
    {
        $this->users = $users;
    }

    public function getUserList(): array
    {
        return $this->users;
    }
}
