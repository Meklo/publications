<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function(Blueprint $table) {
          $table->engine = 'InnoDB';

          $table->increments('id');
          $table->string('title', 20);
          $table->string('type', 2);
          $table->integer('year');
          $table->integer('createur')->unsigned();
          $table->text('contenu');
          $table->string('label', 20)->nullable();
          $table->string('place', 20)->nullable();


        });

        Schema::table('publications', function(Blueprint $table){

          $table->foreign('type')->references('sigle')->on('categories');
          $table->foreign('createur')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('publications');
    }
}
