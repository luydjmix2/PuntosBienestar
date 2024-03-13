<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellnessEventsUser extends Model
{
    use HasFactory;

    protected $table = 'wellness_events_user';

    protected $fillable = [
        'wellness_event_id', 'user_id',
    ];

    public function wellnessEvent()
    {
        return $this->belongsTo(WellnessEvent::class, 'wellness_event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
