<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weeks', function (Blueprint $table) {
            $table->bigIncrements('id')->onDelete('cascade');
            $table->string('name');
            $table->dateTime('start_Week');
            $table->dateTime('end_Week');
            $table->integer('on_flag')->nullable()->default(0); 
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
        Schema::dropIfExists('weeks');
    }
}
