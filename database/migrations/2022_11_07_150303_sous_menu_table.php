<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SousMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sousmenu', function (Blueprint $table) {
            $table->id();
            $table->string('name_sous_menu');
            $table->string('route_sous_menu')->nullable();
            $table->string('level_sous_menu')->nullable();
            $table->text('icone_sous_menu');
            $table->integer('parent_id');
            $table->boolean('etat_sous_menu');
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
        Schema::dropIfExists('sousmenu');
    }
}
