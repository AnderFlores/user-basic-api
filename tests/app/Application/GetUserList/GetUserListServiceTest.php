<?php

namespace Tests\app\Application\GetUserList;

use App\Application\GetUserService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Mockery;
use PHPUnit\Framework\TestCase;

class GetUserListServiceTest extends TestCase
{
    private $getUserListService;
    private $userDataSource;


    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->getUserListService = new GetUserService($this->userDataSource);
    }

    /**
     * @test
     */
    public function returnEmptyUserList()
    {
        $this->userDataSource
            ->expects('setUserList')
            ->with(array())
            ->once()
            ->andReturnNull();

        $this->userDataSource
            ->expects('getUserList')
            ->with()
            ->once()
            ->andReturn(array());

       $response = $this->getUserListService->execute();
       $this->assertEquals(array(), $response);
    }

    /**
     * @test
     */
    public function returnTwoUserList()
    {
        $user1 = new User(1, "user1@users.com");
        $user2 = new User(2, "user2@users.com");
        $this->userDataSource
            ->expects('setUserList')
            ->with(array($user1, $user2))
            ->once()
            ->andReturnNull();

        $this->userDataSource
            ->expects('getUserList')
            ->with()
            ->once()
            ->andReturn(array($user1, $user2));

        $response = $this->getUserListService->execute();
        $this->assertEquals(array($user1, $user2), $response);
    }
}
