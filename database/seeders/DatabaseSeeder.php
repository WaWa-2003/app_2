<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // UserSeeder::class, //done

            OpportunitySeeder::class, // Opportunity
            RequirementSeeder::class, // Opportunity
            QualificationSeeder::class, // Opportunity
            EmployerQuestionSeeder::class, // Opportunity
            EducationSeeder::class, // Applicant
            JobSeeder::class, // Applicant
            OtherSeeder::class, // Applicant
            ApplicationSeeder::class, // "App\Models\Opportunity" not found
            WishlistSeeder::class, // "App\Models\Opportunity" not found
        ]);
    }
}
