<?php

namespace Tests\doubles;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Illuminate\Http\Response;

class FakeUserDataSource implements UserDataSource
{

    private $users;
    public function __construct()
    {
    }

    public function findByEmail(string $email): User
    {
        return new User(1, $email);
    }

    public function findById(int $id):User
    {
        if ($id > 998){
            throw new Exception('User not found');
        }
        else{
            return new User($id, "user@user.com");
        }

    }

    public function setUserList(array $users)
    {
        $this->users = $users;
    }

    public function getUserList():array
    {
        return $this->users;
    }
}
