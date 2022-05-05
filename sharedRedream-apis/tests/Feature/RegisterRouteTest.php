<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterRouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Perform POST /register passing a valid request, should pass.
     *
     * @return void
     */
    public function test_create_user_valid_request_should_pass()
    {
        //Prepare
        $user = User::factory()->make();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ];
        
        //Act
        $response = $this->postJson('/register', $data);
        
        //Assert
        $response->assertCreated()->assertJsonFragment([
            'name' => $user->name,
            'balance' => $user->email,
            'balance' => '0',
        ]);
    }

    /**
     * Perform POST /register passing an invalid request (missing password), should fail.
     *
     * @return void
     */
    public function test_create_user_missing_password_should_fail()
    {
        //Prepare
        $user = User::factory()->make();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => '',
        ];
        
        //Act
        $response = $this->postJson('/register', $data);
        
        //Assert
        $response->assertUnprocessable();
    }
}
