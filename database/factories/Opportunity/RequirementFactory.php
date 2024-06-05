<?php

namespace Database\Factories\Opportunity;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requirement>
 */
class RequirementFactory extends Factory
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
            'requirement' => $this->faker->sentence,
        ];
    }

}
