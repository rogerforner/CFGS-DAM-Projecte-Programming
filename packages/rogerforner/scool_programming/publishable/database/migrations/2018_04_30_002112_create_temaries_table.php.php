<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temaries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nf'); // 1 = NF1, 2 = NF2...
            $table->unsignedInteger('duration');
            $table->string('name', 150);
            $table->string('description')->nullable();
            $table->dateTime('date_start'); // Data d'inici de la UF.
            $table->dateTime('date_end');   // Data de finalització de la UF.
            $table->string('created_by');
            $table->string('modified_by');
            $table->timestamps();
            // Un Nucli Formatiu pertany a una Unitat Formativa.
            $table->integer('training_unit_id')->unsigned()->nullable();
            $table->foreign('training_unit_id')->references('id')->on('training_units')->onDelete('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temaries');
    }
}