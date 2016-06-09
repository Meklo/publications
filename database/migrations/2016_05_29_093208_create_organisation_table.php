<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('organisations', function(Blueprint $table) {
          $table->engine = 'InnoDB'; 
          $table->increments('id')->unsigned();
          $table->string('name', 50);
        });

        $to_insert = array(
          array('name' => 'UTT'),
          array('name' => 'UTBM'),
          array('name' => 'UTC')
        );
        
        // Insert some stuff
        DB::table('organisations')->insert($to_insert);
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('organisations');
    }
}
