<?php

namespace App\Models;

use App\Models\Cluster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Filiere extends Model
{
    use HasFactory;

    protected $fillable = ['nomFiliere'];

    public function clusters(){
        return $this->hasMany(Cluster::class);
    }
}
