<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWedstrijdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wedstrijden', function (Blueprint $table) {
            		
            $table->bigIncrements('id');

            $table->string('competitie');
            $table->boolean('compleet');

            $table->char('type', 1);

            $table->integer('jaar_begin');
            $table->integer('jaar_eind');
            $table->date('datum_begin');
            $table->date('datum_eind');
            
            $table->string('leeftijd');
            $table->string('terrein');
            $table->string('divisie');
            $table->string('geslacht');
            $table->string('speeldag');
            $table->string('locatie')->nullable();
            
            $table->string('club_thuis');
            $table->string('team_thuis');

            $table->string('club_uit');
            $table->string('team_uit');

            $table->integer('score_thuis');
            $table->integer('score_uit');

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
        Schema::drop('wedstrijden');
    }
}
