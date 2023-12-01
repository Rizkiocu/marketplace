<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
   
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_can_register_a_user()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
        ];

        $response = $this->json('POST', '/api/register', $userData);

        $response->assertStatus(201)
            ->assertJson([
                'status' => true,
                'message' => 'successfully Register',
            ]);

        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'role' => 'pembeli', // Sesuaikan dengan nilai default
        ]);
    }

    
    

    /** @test */
    public function it_returns_error_on_invalid_login()
    {
        $userData = [
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'invalid_password',
        ];

        $response = $this->json('POST', '/api/login', $userData);

        $response->assertStatus(401)
            ->assertJson([
                'status' => false,
                'message' => 'The email and password entered are incorrect',
            ]);

        $this->assertGuest();
    }

    

   
}