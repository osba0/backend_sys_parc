<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->text('personnel_id');
            $table->string('nom_perso')->nullable();
            $table->string('prenom_perso')->nullable();
            $table->string('telephone1_perso')->nullable();
            $table->string('telephone2_perso')->nullable();
            $table->string('contact_urgence_perso')->nullable();
            $table->string('email_perso')->nullable();
            $table->string('poste_perso')->nullable();
            $table->string('adresse_perso')->nullable();
            $table->string('departement_perso')->nullable();
            $table->string('region_perso')->nullable();
            $table->string('date_naissance_perso')->nullable();
            $table->string('date_embauche_perso')->nullable();
            $table->string('salaire_horaire_perso')->nullable();
            $table->string('photo_perso')->nullable();
            $table->text('note_perso')->nullable();
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
        Schema::dropIfExists('personnels');
    }
}
