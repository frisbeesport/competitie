<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKlasseringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klassering', function (Blueprint $table) {
           			
            $table->bigIncrements('id');

            $table->string('competitie');
            $table->boolean('compleet');

            $table->char('type', 1);

            $table->integer('jaar_begin');
            $table->integer('jaar_eind');
            $table->date('datum_begin')->nullable();
            $table->date('datum_eind')->nullable();
            
            $table->string('leeftijd');
            $table->string('terrein');
            $table->string('divisie');
            $table->string('geslacht');
            $table->string('speeldag')->nullable();
            $table->string('locatie')->nullable();
            
            $table->string('club');
            $table->string('team');

            $table->integer('ranking_competitie')->nullable();
            $table->integer('score_wedstrijden')->nullable();
            $table->integer('score_punten')->nullable();
            $table->integer('score_voor')->nullable();
            $table->integer('score_tegen')->nullable();

            $table->integer('ranking_spirit')->nullable();
            $table->integer('score_spirit')->nullable();

            $table->string('opmerking')->nullable();

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
        Schema::drop('klassering');
    }
}
