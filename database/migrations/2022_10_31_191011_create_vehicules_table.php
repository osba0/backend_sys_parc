<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->text('vehicule_id');
            $table->string('numero_serie')->nullable();
            $table->string('modele')->nullable();
            $table->string('fabricant')->nullable();
            $table->string('annnee')->nullable();
            $table->string('plaque')->nullable();
            $table->string('type')->nullable();
            $table->string('plaque_expiration')->nullable();
            $table->string('couleur')->nullable();
            $table->string('num_moteur')->nullable();
            $table->string('fournisseur')->nullable();
            $table->string('type_carburant')->nullable();
            $table->string('date_acquisition')->nullable();
            $table->string('valeur_a_acquisition')->nullable();
            $table->string('odometre')->nullable();
            $table->string('type_odometre')->nullable(); // Km, Miles, Hrs
            $table->text('note_vehicule')->nullable();
            $table->string('photo_vehicule')->nullable();
            $table->boolean('etat_vehicule')->nullable();
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
        Schema::dropIfExists('vehicules');
    }
}
