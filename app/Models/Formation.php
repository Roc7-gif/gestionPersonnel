<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $table = 'formations';

    protected $fillable = [
        'intitule',
        'author',
        'objectifs',
        'img_path',
        'profils_beneficiaires',
        'profil_formateur',
        'type_formation',
        'debut',
        'fin',
        'demandeformation_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function demandeformation()
    {
        return $this->belongsTo(DemandeFormation::class, 'demandeformation_id');
    }

}