<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluates', function (Blueprint $table) {
            $table->bigIncrements('id')->onDelete('cascade');
            $table->foreignId('grade_id')->references('id')->on('grades')->onDelete('cascade'); 
            $table->foreignId('player_id')->references('id')->on('players')->onDelete('cascade'); 
            $table->double('average');  
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
        Schema::dropIfExists('evaluates');
    }
}
