<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $table = 'formations';

    protected $fillable = [
        'intitule',
        'nombre_participants',
        'objectifs',
        'is_interieur',
        'img_path',
        'justification_choix',
        'profils_beneficiaires',
        'module_nom',
        'duree',
        'profil_formateur',
        'type_formation',
        'observation'
    ];
}
