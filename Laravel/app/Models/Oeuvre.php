<?php

namespace App\Models;

use App\Models\Artiste;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oeuvre extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'annee', 'artiste_id', 'categorie_id', 'image'];

    public function artiste(){
        return $this->belongsTo(Artiste::class);
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}
