<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id')->onDelete('cascade');
            $table->foreignId('training_id')->references('id')->on('trainings')->onDelete('cascade'); 
            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade'); 
            $table->foreignId('player_id')->references('id')->on('players')->onDelete('cascade'); 
            $table->integer('note_1');  
            $table->integer('note_2');  
            $table->integer('note_3');  
            $table->float('moy');  
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
        Schema::dropIfExists('grades');
    }
}
