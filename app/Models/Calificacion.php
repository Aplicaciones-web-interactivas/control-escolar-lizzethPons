<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificaciones';

    protected $fillable = [
        'grupo_id',
        'user_id',
        'calificacion',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
