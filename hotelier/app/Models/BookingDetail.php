<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'room_id', 
        "booking_id"
       
    ];

    public function booking():BelongsTo{
        
        return $this->belongsTo(Booking::class);
        
    }

    public function room():BelongsTo{
        
        return $this->belongsTo(Room::class);
        
    }

   
}
