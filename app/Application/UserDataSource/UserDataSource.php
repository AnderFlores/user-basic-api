<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

Interface UserDataSource
{
    public function findById(string $id): User;
    public function findByEmail(string $email): User;
    public function setUserList(array $users);
    public function getUserList(): array;
}
