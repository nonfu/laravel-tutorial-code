<?php

namespace Tests\Unit;

use App\Contracts\UserRepositoryInterface;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserTest()
    {
        $repository = \Mockery::mock(UserRepositoryInterface::class);
        $repository->shouldReceive('all')->once()->andReturn(['学院君']);
        $this->instance(UserRepositoryInterface::class, $repository);
        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertViewHas('users', ['学院君']);
    }
}
