<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Calendar;
use App\Models\User;
use App\Models\Role;

class CalendarTest extends TestCase
{
    public function testGetAll()
    {
        $response = $this->get('/api/calendars');

        $response->assertStatus(200);
    }

    public function testGetById()
    {
        $calendar = Calendar::first();
        $response = $this->get("/api/calendars/{$calendar->id}");

        $response->assertStatus(200);
    }

    public function testGetByUser()
    {
        $user = User::first();
        $response = $this->get("/api/calendars/{$user->id}");

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $calendar = Calendar::factory()->make();
        $response = $this->post("/api/calendars", $calendar->toArray());

        $response->assertStatus(200);
    }
}
