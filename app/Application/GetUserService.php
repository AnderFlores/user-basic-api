<?php

namespace App\Application;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;

class GetUserService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;
    /**
     * GetUserService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }
    /**
     * @throws Exception
     */
    public function getList(): array
    {
        $userList = $this->userDataSource->getUserList();
        return $userList;
    }
    public function getUser(int $id): User
    {
        return $this->userDataSource->findById($id);

    }
}
