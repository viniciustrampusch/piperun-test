<?php

namespace Database\Factories;

use App\Models\Calendar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CalendarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Calendar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_at' => Carbon::now()->format('Y-m-d'),
            'start_at_time' => Carbon::now()->format('H:i'),
            'end_at' => Carbon::now()->addHour()->format('Y-m-d'),
            'end_at_time' => Carbon::now()->addHour()->format('H:i'),
            'description' => Str::random(10),
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->unique()->safeEmail,
            'requested_id' => User::factory()->create()->id
        ];
    }
}
