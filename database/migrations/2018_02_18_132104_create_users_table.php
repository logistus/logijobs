<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('verify_token')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('nationalities')->nullable();
            $table->unsignedInteger('born_country_id')->nullable();
            $table->foreign('born_country_id')->references('id')->on('countries');
            $table->enum('marital_status', ['single', 'married', 'not_specified'])->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('military_status', ['done', 'doing', 'not_done', 'postponed', 'exempt'])->nullable();
            $table->string('military_exempt_reason')->nullable();
            $table->date('military_discharge_date')->nullable();
            $table->date('military_postpone_date')->nullable();
            $table->string('licence', 25)->nullable();
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
}