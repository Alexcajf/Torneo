<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'edad', 'torneo_id', 'is_winner'];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }
}
