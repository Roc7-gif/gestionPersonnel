<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeFormation extends Model
{
    //
 protected $fillable = [
    'intitule', 'nombre_participants', 'objectifs', 'is_interieur', 
    'justification_choix', 'profils_beneficiaires', 'module_nom', 
    'duree', 'profil_formateur', 'type_formation', 'observation', 'user_create_id', 'user_actuel_id'
];
public function author(){
        return $this->belongsTo(User::class, 'user_create_id');
        
}
public function status(){
        return $this->hasMany(DemandeFormationsStatus::class, 'demandeformation_id');
        
}
}
