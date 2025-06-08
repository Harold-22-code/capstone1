<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'reservation_id',
        'reservation_date',
        'reservation_time',
        // 'number_of_people',
        'status',
    ];


    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

      public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
