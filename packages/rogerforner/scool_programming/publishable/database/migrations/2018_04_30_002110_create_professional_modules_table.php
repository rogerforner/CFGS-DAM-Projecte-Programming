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
            $table->unsignedInteger('mp'); // 1 = MP1, 2 = MP2...
            $table->string('name', 150);
            $table->string('section1')->nullable(); // Estratègies metodològiques.
            $table->string('section2')->nullable(); // Criteris d'avaluació.
            $table->string('section3')->nullable(); // Recursos.
            $table->string('section4')->nullable(); // Dual.
            $table->boolean('approved')->default(false); // Acceptada pel cap de departament?
            $table->dateTime('date_start'); // Data d'inici del MP.
            $table->dateTime('date_end');   // Data de finalització del MP.
            $table->string('created_by');
            $table->string('modified_by');
            $table->timestamps();
<<<<<<< HEAD:packages/rogerforner/scool_programming/publishable/database/migrations/2018_04_30_002110_create_professional_modules_table.php
=======
            // Ho crea una persona (usuari).
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            // Un Mòdul Professional ha de pertànyer a un Cicle Formatiu.
            $table->integer('training_cycle_id')->unsigned();
            $table->foreign('training_cycle_id')->references('id')->on('training_cycles');
>>>>>>> parent of ac1a959... [packProgramming] Migrations; onDelete():packages/rogerforner/scool_programming/publishable/database/migrations/2018_04_30_172212_create_professional_modules_table.php
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