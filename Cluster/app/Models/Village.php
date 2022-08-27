<?php

namespace App\Models;

use App\Models\Cluster;
use App\Models\Arrondissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory;

    protected $fillable = ['nomVillage', 'arrondissement_id'];

    public function arrondissement(){
        return $this->belongsTo(Arrondissement::class);
    }

    public function clusters(){
        return $this->hasMany(Cluster::class);
    }
}
