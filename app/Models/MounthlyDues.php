<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MounthlyDues extends Model
{
    use HasFactory;
    protected $table = 'monthly_dues';
    protected $fillable = ['currency', 'date', 'photo', 'status', 'month_id', 'user_id '];

    // Relasi one-to-one dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function month()
    {
        return $this->belongsTo(Monthly::class);
    }
}
