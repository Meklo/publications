<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_user', function(Blueprint $table) {
          $table->engine = 'InnoDB';  
            
          $table->increments('id')->unsigned();
          $table->integer('publication_id')->unsigned();
          $table->integer('user_id')->unsigned();
          $table->integer('ordre');   
        });
        
        Schema::table('publication_user', function(Blueprint $table){
            
            
          $table->foreign('publication_id')->references('id')->on('publications');  
          $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('publication_user');
    }
}
