<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDdues extends Model
{
    use HasFactory;

    protected $table = 'event_dues';
    protected $fillable = ['currency', 'date', 'photo', 'status', 'event_id ', 'user_id '];

    // Relasi one-to-one dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
