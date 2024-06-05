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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opportunity_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('salary_expectation')->nullable();
            $table->date('earliest_possible_start_date')->nullable();
            $table->string('application_status')->nullable();
            $table->boolean('next_step_status')->nullable();
            $table->string('notes')->nullable();
            $table->date('prescreen_date')->nullable();
            $table->date('short_list_date')->nullable();
            $table->date('first_interview_date')->nullable();
            $table->date('second_interview_date')->nullable();
            $table->date('third_interview_date')->nullable();
            $table->date('fourth_interview_date')->nullable();
            $table->date('offer_date')->nullable();
            $table->boolean('offer_accept_status')->nullable();
            $table->date('offer_accept_date')->nullable();
            $table->date('offer_reject_date')->nullable();
            $table->date('joining_date')->nullable();
            $table->timestamps();

            $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
/**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
