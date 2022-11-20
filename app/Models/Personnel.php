<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'personnel_id',
        'nom_perso',
        'prenom_perso',
        'telephone1_perso',
        'telephone2_perso',
        'contact_urgence_perso',
        'email_perso',
        'poste_perso',
        'adresse_perso',
        'departement_perso',
        'region_perso',
        'date_naissance_perso',
        'date_embauche_perso',
        'salaire_horaire_perso',
        'photo_perso',
        'note_perso'
    ];
}
