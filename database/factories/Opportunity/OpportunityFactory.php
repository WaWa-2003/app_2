<?php

namespace Database\Factories\Opportunity;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opportunity>
 */
class OpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'experience_level' => $this->faker->randomElement(['Entry Level', 'Mid Level', 'Senior Level']),
            'department' => $this->faker->word,
            'salary_min' => $this->faker->numberBetween(30000, 80000),
            'salary_max' => $this->faker->numberBetween(80000, 150000),
            'salary_currency' => $this->faker->randomElement(['USD', 'EUR', 'GBP']),
            'job_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'location' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'job_closing_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'available_status' => $this->faker->boolean,
            'created_by_who' => $this->faker->name,
            'hashtag_keywords' => $this->faker->words(3, true),
            'open_to_gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'reporting_to' => $this->faker->name,
        ];
    }
}
