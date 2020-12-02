<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->tinyInteger('gender')->comment('0: Male; 1: Female')->nullable();
            $table->bigInteger('annual_income')->nullable();
            $table->tinyInteger('occupation')->comment('0: Private job; 1: Government job; 2: Business;')->nullable();
            $table->tinyInteger('family_type')->comment('0: Joint family; 1: Nuclear family;')->nullable();
            $table->tinyInteger('manglik')->comment('0: No; 1: Yes;')->nullable();
            $table->longText('expected_income')->nullable();
            $table->longText('expected_occupation')->nullable();
            $table->longText('expected_family_type')->nullable();
            $table->tinyInteger('expected_manglik')->comment('0: No; 1: Yes; 2: Both;')->nullable();
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
