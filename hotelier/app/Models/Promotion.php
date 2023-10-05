<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'code', 
        'reduciton', 
    
       
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
