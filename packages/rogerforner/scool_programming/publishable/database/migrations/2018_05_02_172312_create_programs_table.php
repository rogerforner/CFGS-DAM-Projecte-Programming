<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('section1')->nullable(); // MP:Estratègies metodològiques. | UF:Activitats.
            $table->string('section2')->nullable(); // MP:Criteris d'avaluació. | UF:Resultats d’aprenentatge i criteris d’avaluació.
            $table->string('section3')->nullable(); // MP:Recursos. | UF:Continguts.
            $table->string('section4')->nullable(); // MP:Dual. | UF:Criteris avaluació.
            $table->boolean('approved')->default(false); // Acceptada pel cap de departament?
            // Relació amb Professional Module
            // Relació amb Unit Training
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
