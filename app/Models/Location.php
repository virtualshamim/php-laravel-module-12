<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name'];

    // Relationship with bookings
    public function trips()
    {
        return $this->belongsToMany(Trip::class);
    }
}
