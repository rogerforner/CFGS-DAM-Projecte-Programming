<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mp');  // 1 = MP1, 2 = MP2...
            $table->string('name', 150);
            $table->dateTime('date_start'); // Data d'inici del MP.
            $table->dateTime('date_end');   // Data de finalització del MP.
            $table->timestamps();
            // Un Mòdul Professional pertany a un Cicle Formatiu.
            $table->integer('training_cycle_id')->unsigned();
            $table->foreign('training_cycle_id')->references('id')->on('training_cycles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_modules');
    }
}
