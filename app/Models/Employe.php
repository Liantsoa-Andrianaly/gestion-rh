<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'poste',
        'departement',
        'telephone'
    ];

    public function adresses() {
        return $this->hasMany(Adresse::class);
    }

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function project()
{
    return $this->belongsTo(Project::class);
}

   
}
