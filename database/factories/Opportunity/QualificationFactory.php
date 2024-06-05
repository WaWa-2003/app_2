<?php

namespace Database\Factories\Opportunity;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Qualification>
 */
class QualificationFactory extends Factory
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
            'qualification' => $this->faker->sentence,
        ];
    }
}
