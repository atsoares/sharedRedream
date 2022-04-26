<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        //Prepare creating the user
        $user = User::factory()->create();

        //Act 
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password
        ]);

        //Assert
        $response->assertStatus(200);
    }
}
