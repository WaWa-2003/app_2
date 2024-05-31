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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('experience_level');
            $table->string('department');
            $table->integer('salary_min');
            $table->integer('salary_max');
            $table->string('salary_currency');
            $table->string('job_type');
            $table->string('location');
            $table->text('description');
            $table->date('jobClosingDate')->nullable();
            $table->boolean('availableStatus');
            $table->string('createdByWho');
            $table->string('hashtagKeyWords')->nullable();
            $table->string('openToGender')->nullable();
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
        Schema::dropIfExists('opportunities');
    }
};
