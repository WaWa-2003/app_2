<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Applicant\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'opportunity_id' => function () {
                return \App\Models\Opportunity\Opportunity::factory()->create()->id;
            },
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'salary_expectation' => $this->faker->numberBetween(30000, 150000),
            'earliest_possible_start_date' => $this->faker->date(),
            'application_status' => $this->faker->randomElement(['pending', 'rejected', 'accepted']),
            'next_step_status' => $this->faker->boolean,
            'notes' => $this->faker->sentence,
            'prescreen_date' => $this->faker->date(),
            'short_list_date' => $this->faker->date(),
            'first_interview_date' => $this->faker->date(),
            'second_interview_date' => $this->faker->date(),
            'third_interview_date' => $this->faker->date(),
            'fourth_interview_date' => $this->faker->date(),
            'offer_date' => $this->faker->date(),
            'offer_accept_status' => $this->faker->boolean,
            'offer_accept_date' => $this->faker->date(),
            'offer_reject_date' => $this->faker->date(),
            'joining_date' => $this->faker->date(),
        ];
    }
}
