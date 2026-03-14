<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'horario_id',
        'nombre',
    ];

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }
}