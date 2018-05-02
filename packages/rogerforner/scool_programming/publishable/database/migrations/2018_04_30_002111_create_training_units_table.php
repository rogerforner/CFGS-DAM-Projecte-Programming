<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_units', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uf'); // 1 = UF1, 2 = UF2...
            $table->string('name', 150);
            $table->string('section1')->nullable(); // Activitats.
            $table->string('section2')->nullable(); // Resultats d’aprenentatge i criteris d’avaluació.
            $table->string('section3')->nullable(); // Continguts.
            $table->string('section4')->nullable(); // Criteris avaluació.
            $table->boolean('approved')->default(false); // Acceptada pel cap de departament?
            $table->dateTime('date_start'); // Data d'inici de la UF.
            $table->dateTime('date_end');   // Data de finalització de la UF.
            $table->string('created_by');
            $table->string('modified_by');
            $table->timestamps();
            // Una Unitat Formativa pertany a un Mòdul Professional.
            $table->integer('professional_module_id')->unsigned()->nullable();
            $table->foreign('professional_module_id')->references('id')->on('professional_modules')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_units');
    }
}