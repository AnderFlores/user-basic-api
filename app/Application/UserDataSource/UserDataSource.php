<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

Interface UserDataSource
{
    public function findByEmail(string $email): User;
    public function findById(int $id): User;
    public function getUserList(): array;
    public function setUserList(array $users);


}
