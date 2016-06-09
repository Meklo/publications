<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
//        Schema::table('users', function(Blueprint $table) {
//           $table->foreign('equipe')->references('id')->on('equipes')
//               ->onDelete('cascade')
//               ->onUpdate('cascade');
//       });
//
//       Schema::table('equipes', function(Blueprint $table) {
//          $table->foreign('organisation')->references('id')->on('organisations')
//              ->onDelete('cascade')
//              ->onUpdate('cascade');
//      });
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
