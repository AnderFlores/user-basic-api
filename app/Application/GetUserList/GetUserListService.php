<?php

namespace App\Application\GetUserList;

use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserListService extends BaseController
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;
    /**
     * GetUserListService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }
    /**
     * @throw Exception
     */
    public function __execute(): array
    {
        return $this->userDataSource->getUserList();
    }
}
