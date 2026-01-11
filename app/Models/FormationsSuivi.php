<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationsSuivi extends Model
{
    // $fi
    public function participants() {
    return $this->belongsToMany(User::class, 'formations_suivis');
}
}
