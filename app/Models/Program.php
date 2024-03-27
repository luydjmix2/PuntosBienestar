<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
    ];

    // Relación con la tabla wellness_points
    public function wellnessPoints()
    {
        return $this->hasMany(WellnessPoint::class);
    }
}
