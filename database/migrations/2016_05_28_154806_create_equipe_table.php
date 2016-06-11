<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('equipes', function(Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->increments('id')->unsigned();
          $table->string('name', 50);
          $table->integer('organisation')->unsigned();
        });

        Schema::table('users', function(Blueprint $table) {
          $table->foreign('equipe')->references('id')->on('equipes');
        });

        Schema::table('equipes', function(Blueprint $table) {
          $table->foreign('organisation')->references('id')->on('organisations');
        });

        $to_insert = array(
          array('name' => 'ERA', 'organisation' => 1),
          array('name' => 'LOSI', 'organisation' => 1),
          array('name' => 'Tech-cico', 'organisation' => 1)
        );

        // Insert some stuff
        DB::table('equipes')->insert($to_insert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('equipes');
    }
}
