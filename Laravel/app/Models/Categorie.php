<?php

namespace App\Models;

use App\Models\Oeuvre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['nomCategorie'];

    public function oeuvres(){
        return $this->hasMany(Oeuvre::class);
    }
}
