<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('resume_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('city_id');
            $table->string('start_date', 7);
            $table->boolean('still_working');
            $table->string('end_date', 7)->nullable();
            $table->string('company_name');
            $table->text('job_description')->nullable();
            $table->string('job_title');
            $table->unsignedInteger('work_type');
            $table->foreign('resume_id')->references('id')->on('resumes');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('work_type')->references('id')->on('work_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_experiences');
    }
}
