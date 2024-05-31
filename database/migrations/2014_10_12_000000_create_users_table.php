<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->notNullable();
            $table->string('email')->unique()->notNullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->notNullable();
            $table->string('type')->default('user');

            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('currently_looking_job')->nullable();
            $table->string('current_job_position')->nullable();
            $table->integer('expected_salary')->nullable();
            $table->string('resume_cv_name')->nullable();
            $table->string('resume_cv_file_path')->nullable();
            $table->decimal('experience_year', 5, 2)->nullable();
            $table->string('photo_path')->nullable();
            $table->boolean('complete_profile_status')->default(false);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
