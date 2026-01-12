<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeFormation extends Model
{
    //
 protected $fillable = [
    'intitule', 'debut', 'objectifs',
     'profils_beneficiaires', 'img_path',
      'type_formation', 'fin', 'user_create_id', 'user_actuel_id'
];
public function author(){
        return $this->belongsTo(User::class, 'user_create_id');
        
}
public function status(){
        return $this->hasMany(DemandeFormationsStatus::class, 'demandeformation_id');
        
}
public function statusParentNull()
    {
        return $this->hasOne(DemandeFormationsStatus::class, 'demandeformation_id')
            ->whereHas('user', function ($q) {
                $q->whereNull('parent_id');
            })
            ->latest(); // prend le dernier status si plusieurs
    }
    public function formation()
    {
        return $this->hasOne (Formation::class , 'demandeformation_id' );  
        }
    
}
