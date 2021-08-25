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
    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertJson([
                "error" => 1,
                "statusCode" => 422,
                "message" => "The email field is required.The password field is required.",
                "data" => ""
            ]);
    }

    public function testSuccessfulLogin()
    {
        $user = User::factory()->create([
            'email' => 'zrshishir1@gmail.com',
            'password' => bcrypt('123456'),
            'currency' => 'USD',
        ]);


        $loginData = ['email' => 'zrshishir@gmail.com', 'password' => '123456'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->assertJsonStructure([
                "error",
                "statusCode",
                "message",
                "data" => [
                    "users" => [
                                "id",
                                "name",
                                "email",
                                "email_verified_at",
                                "currency",
                                "created_at",
                                "updated_at",
                                "api_token",
                                "token_type",
                        ]
                    ]
            ]);

        $this->assertAuthenticated();
    }
}
