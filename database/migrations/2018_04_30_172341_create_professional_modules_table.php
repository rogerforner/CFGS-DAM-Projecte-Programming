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
            $table->unsignedInteger('mp');          // 1 = MP1, 2 = MP2...
            $table->string('name', 150);
            $table->string('section1')->nullable(); // Estratègies metodològiques.
            $table->string('section2')->nullable(); // Criteris d'avaluació.
            $table->string('section3')->nullable(); // Recursos.
            $table->string('section4')->nullable(); // Dual.
            $table->boolean('approved')->default(false); // Acceptada pel cap de departament?
            $table->timestamps();
            // Un Mòdul Professional ha de pertànyer a un Cicle Formatiu.
            $table->integer('training_cycle_id')->unsigned();
            $table->foreign('training_cycle_id')->references('id')->on('training_cycles');
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
