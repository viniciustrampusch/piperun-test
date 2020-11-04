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
        $start_at = Carbon::now()->addDays(rand(1, 365))->addHours(rand(1, 24));
        $end_at = $start_at->addHour();

        return [
            'start_at' => $start_at->format('Y-m-d'),
            'start_at_time' => $start_at->format('H:i'),
            'end_at' => $end_at->format('Y-m-d'),
            'end_at_time' => $end_at->format('H:i'),
            'description' => Str::random(10),
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->unique()->safeEmail,
            'requested_id' => User::factory()->create()->id
        ];
    }
}
