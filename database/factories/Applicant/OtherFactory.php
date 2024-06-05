<?php

namespace Database\Factories\Applicant;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Other>
 */
class OtherFactory extends Factory
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
            'organization_name' => $this->faker->company,
            'country' => $this->faker->country,
            'type' => $this->faker->randomElement(['volunteer', 'internship', 'freelance']),
        ];
    }
}
