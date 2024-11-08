<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'employe_id', 
        'date', 
        'est_present', 
        'motif'
    ];

    // Dans le modèle Presence.php
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

}
