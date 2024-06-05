<?php

namespace Database\Factories\Applicant;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
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
            'subject' => $this->faker->sentence,
            'institution' => $this->faker->company,
            'country' => $this->faker->country,
            'type' => $this->faker->randomElement(['high school', 'bachelor', 'master', 'phd']),
        ];
    }
}
