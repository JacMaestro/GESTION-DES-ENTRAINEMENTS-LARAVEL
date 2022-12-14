<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id')->onDelete('cascade');
            $table->dateTime('start_Week')->nullable()->default(now());
            $table->dateTime('end_Week')->nullable()->default(now());
            $table->dateTime('date_training');  
            $table->foreignId('week_id')->references('id')->on('weeks')->onDelete('cascade'); 
            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade'); 
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
        Schema::dropIfExists('trainings');
    }
}
