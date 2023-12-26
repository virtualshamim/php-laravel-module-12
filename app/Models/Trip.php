<?php

namespace App\Models;

use App\Models\Bus;
use App\Models\Booking;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    protected $fillable = ['date', 'from', 'to', 'seats', 'fare'];

    // Relationship with bookings
    public function bus()
    {
        return $this->hasOne(Bus::class);
    }
    public function location()
    {
        return $this->hasOne(Location::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
