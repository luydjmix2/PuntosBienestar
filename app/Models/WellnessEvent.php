<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellnessEvent extends Model
{
    use HasFactory;

    protected $table = 'wellness_events';

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date','points','url_up_points'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'wellness_events_user', 'wellness_event_id', 'user_id')->withTimestamps();
    }
}
