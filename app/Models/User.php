<?php

namespace App\Models;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password'];

    // Relationship with bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
