<?php

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
        //
        Schema::create('users', function(Blueprint $table) {

          $table->engine = 'InnoDB';

          $table->increments('id')->unsigned();
          $table->string('first_name', 50);
      	  $table->string('name', 50);
          $table->string('email', 50);
          $table->string('password', 255);
          $table->integer('equipe')->unsigned();
          $table->boolean('admin')->default(false);
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
        //
        Schema::drop('users');
    }
}
