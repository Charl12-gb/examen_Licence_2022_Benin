<?php

namespace App\Models;

use App\Models\Filiere;
use App\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cluster extends Model
{
    use HasFactory;

    protected $fillable = ['nomCluster', 'imgCluster', 'filiere_id', 'village_id'];

    public function filiere(){
        return $this->belongsTo(Filiere::class);
    }

    public function village(){
        return $this->belongsTo(Village::class);
    }
}
