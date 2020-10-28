<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function testGetAll()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }

    public function testGetById()
    {
        $user = User::first();
        $response = $this->get("/api/users/{$user->id}");

        $response->assertStatus(200);
    }
}
