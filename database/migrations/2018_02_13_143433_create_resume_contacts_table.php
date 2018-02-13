<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('resume_id');
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('county_id')->nullable();
            $table->string('home_phone', 10)->nullable();
            $table->string('mobile_phone', 10)->nullable();
            $table->string('email')->nullable();
            $table->string('personal_web')->nullable();
            $table->foreign('resume_id')->references('id')->on('resumes');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('county_id')->references('id')->on('counties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_contacts');
    }
}
