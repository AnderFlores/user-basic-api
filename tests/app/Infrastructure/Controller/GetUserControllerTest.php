<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Tests\doubles\FakeUserDataSource;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUserControllerTest extends TestCase
{
    private  $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, function () {
            return $this->userDataSource;
        });
    }

    /**
     * @test
     */
    public function userWithGivenIdDoesNotExist()
    {
        $this->userDataSource
            ->expects('findById')
            ->with(999)
            ->once()
            ->andThrow(new Exception('User not found'));

        $response = $this->get('/api/users/999');
        $this->expectException(Exception::class);
        $response->assertExactJson(['error' => 'User not found']);

    }

    /**
     * @test
     */
    public function userWithGivenIdDoesExist()
    {

        $email = 'user@user.com';
        $user = new User(1, $email);


        $this->userDataSource
            ->expects('findById')
            ->with(1)
            ->once()
            ->andReturn($user);

        $response = $this->get('/api/users/1');

        $response->assertExactJson(['id' => 1, 'email' => $email]);
    }
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

        $response->assertExactJson(['list'=>array(
            'id1' => '1',
            'id2' => '2',
            'id3' => '3',
        )]);
    }
}
