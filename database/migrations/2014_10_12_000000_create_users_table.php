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
            $table->increments('id'); # * need this field
            $table->string('name');
            # Possible added fields: (two following fields)
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('email')->unique(); # *
            $table->string('password'); # *
            $table->rememberToken(); # *
            $table->timestamps(); # *
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
