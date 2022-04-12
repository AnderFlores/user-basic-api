<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Tests\doubles\FakeUserDataSource;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUserListControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function returnEmptyUserList()
    {
        $this->userDataSource
            ->expects('getUserList')
            ->once()
            ->andReturn(array(""));

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(['list'=>array("")]);
    }

    /**
     * @test
     */
    public function returnHappyPathList()
    {
        $this->userDataSource
            ->expects('getUserList')
            ->once()
            ->andReturn(
                     response()->json([
                     'id1' => '1',
                     'id2' => '2',
                     'id3' => '3',
                     ], Response::HTTP_OK)
            );

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(['list'=>array("")]);
    }
}
