<?php

namespace Tests\app\Application\GetUserList;

use App\Application\EarlyAdopter\IsEarlyAdopterService;
use App\Application\GetUserList\GetUserListService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\doubles\FakeUserDataSource;

class GetUserListServiceTest extends TestCase
{
    private GetUserListService $getUserListService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->getUserListService = new GetUserListService($this->userDataSource);
    }

    /**
     * @test
     */
    public function returnEmptyUserList()
    {
        $this->userDataSource->setUserList(array());

        $this->userDataSource
            ->expects('getUserList')
            ->with()
            ->once()
            ->andReturn(array());

        $response = $this->getUserListService->getUserList();

        $this->assertEquals(array(), $response);
    }

    /**
     * @test
     */
    public function returnTwoUserList()
    {
        $user1 = new User(1, "user1@users.com");
        $user2 = new User(2, "user2@users.com");
        $this->fakeUserDataSource->setUserList(array($user1, $user2));

        $response = $this->fakeUserDataSource->getUserList();

        $this->assertEquals(array($user1, $user2), $response);
    }
}
