<?php

namespace App\Models;

use App\Models\Commune;
use App\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arrondissement extends Model
{
    use HasFactory;

    protected $fillable = ['nomArrondissement', 'commune_id'];

    public function commune(){
        return $this->belongsTo(Commune::class);
    }

    public function villages(){
        return $this->hasMany(Village::class);
    }
}
