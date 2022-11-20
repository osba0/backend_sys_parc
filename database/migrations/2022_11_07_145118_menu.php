<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Menu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('nom_menu');
            $table->string('route_menu')->nullable();
            $table->string('level_menu')->nullable();
            $table->text('icone_menu');
            //$table->boolean('a_sous_menu');
            $table->boolean('etat_menu');
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
        Schema::dropIfExists('menu');
    }
}
