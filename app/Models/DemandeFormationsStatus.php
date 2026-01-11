<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeFormationsStatus extends Model
{
    //
       protected $fillable = [
        'demandeformation_id',
        'status',
        'user_id'
    ];
    public function user  (){
        return $this->belongsTo(User::class, 'user_id'); 
    }
    
    public function demandeformation  (){
        return $this->belongsTo( DemandeFormation::class, 'demandeformation_id'); 
    }
}
