<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_cycles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->unique();
            $table->string('description')->nullable();
            $table->timestamps();
            // Un Cicle Formatiu ha de pertànyer a una Família Professional.
            $table->integer('professional_family_id')->unsigned();
            $table->foreign('professional_family_id')->references('id')->on('professional_families');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_cycles');
    }
}
