<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUserControllerTest extends TestCase
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
    public function userWithGivenIdDoesNotExist()
    {
        $this->userDataSource
            ->expects('findById')
            ->with('999')
            ->never()
            ->andThrow(new Exception('User not found'));

        $response = $this->get('/api/user/999');

        $response->assertExactJson(['error' => 'User does not exist']);
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
            ->with('1')
            ->once()
            ->andReturn($user);

        $response = $this->get('/api/user/1');

        $response->assertExactJson(['id' => '1', 'email' => $email]);
    }
}
