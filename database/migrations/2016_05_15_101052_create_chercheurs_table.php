<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChercheursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('chercheurs', function(Blueprint $table) {
      		$table->increments('id');
          $table->string('first_name', 50);
      		$table->string('name', 50);
          $table->string('login', 50);
          $table->string('password', 60);
          $table->string('organisation', 50);
          $table->string('équipe', 50);
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
        Schema::drop('chercheurs');
    }
}
