<?php

namespace Database\Factories\Applicant;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Applicant\Job;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'position' => $this->faker->jobTitle,
            'company_name' => $this->faker->company,
            'country' => $this->faker->country,
            'responsibility' => $this->faker->sentence,
            'resign_reason' => $this->faker->sentence,
            'salary' => $this->faker->numberBetween(30000, 150000),
            'type' => $this->faker->randomElement(['full-time', 'part-time', 'contract']),
        ];
    }
}
