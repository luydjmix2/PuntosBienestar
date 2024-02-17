<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellnessPoint extends Model
{
    use HasFactory;

    protected $table = 'wellness_points';

    protected $fillable = [
        'user_id',
        'numero_de_identificacion',
        'celular',
        'programa',
        'jornada',
        'puntos_acumulados',
    ];

    // Si tienes relaciones con otros modelos, puedes definirlas aquí

    /**
     * Obtener el usuario asociado a este registro de puntos de bienestar.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
