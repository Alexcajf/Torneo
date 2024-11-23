<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'videojuego', 'fecha'];

    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }
}