<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousMenu extends Model
{
    use HasFactory;
    protected $table = 'sousmenu';
    protected $fillable = ['name_sous_menu','icone_sous_menu', 'route_sous_menu', 'level_sous_menu', 'parent_id', 'etat_sous_menu'];
}
