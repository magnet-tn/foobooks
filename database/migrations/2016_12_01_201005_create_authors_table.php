<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
    * Run the migrations.
    *
    */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps(); //created at and updated at

            $table->string('first_name');
            $table->string('last_name');
            $table->integer('birth_year');
            $table->string('bio_url');

        });
    }


    /**
    * Reverse the migrations.
    *
    */
    public function down()
    {
        Schema::drop('authors');
    }
}
