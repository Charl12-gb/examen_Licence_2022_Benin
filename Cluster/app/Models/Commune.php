<?php

namespace App\Models;

use App\Models\Departement;
use App\Models\Arrondissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = ['nomCommune', 'deoartement_id'];

    public function departement(){
        return $this->belongsTo(Departement::class);
    }

    public function arrondissements(){
        return $this->hasMany(Arrondissement::class);
    }
}
