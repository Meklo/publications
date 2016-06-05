<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        Schema::create('categories', function(Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->string('name', 50);
          $table->string('sigle', 2);
        });

        $to_insert = array(
          array('name' => 'Article dans des Revues Internationales', 'sigle' => 'RI'),
          array('name' => 'Article dans des Conférences Internationales', 'sigle' => 'CI'),
          array('name' => 'Article dans des Revues Françaises', 'sigle' => 'RF'),
          array('name' => 'Article dans des Conférences Françaises', 'sigle' => 'CF'),
          array('name' => 'Ouvrage Scientifique', 'sigle' => 'OS'),
          array('name' => 'Thèse de doctorat', 'sigle' => 'TD'),
          array('name' => 'Brevet', 'sigle' => 'BV'),
          array('name' => 'Autre Production', 'sigle' => 'AP')
        );

        // Insert some stuff
        DB::table('categories')->insert($to_insert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
