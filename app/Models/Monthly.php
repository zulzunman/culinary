<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthly extends Model
{
    use HasFactory;
    protected $table = 'month';
    protected $fillable = ['name '];

    // Relasi one-to-one dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mounthly()
    {
        return $this->hasOne(MounthlyDues::class);
    }
}
