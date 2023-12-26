<?php

namespace App\Models;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bus extends Model
{
    protected $fillable = ['name'];

    // Relationship with bookings
    public function trips()
    {
        return $this->belongsToMany(Trip::class);
    }
}
