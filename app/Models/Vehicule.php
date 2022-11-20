<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'vehicule_id',
        'numero_serie',
        'modele',
        'fabricant',
        'annnee',
        'plaque',
        'type',
        'plaque_expiration',
        'couleur',
        'num_moteur',
        'fournisseur',
        'type_carburant',
        'date_acquisition',
        'valeur_a_acquisition',
        'odometre',
        'note_vehicule',
        'photo_vehicule',
        'etat_vehicule',
        'type_odometre'
    ];
}
