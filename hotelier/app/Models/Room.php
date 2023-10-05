<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'name', 
        'status', 
        'price', 
        'description', 
        'quantity', 
        'room_type_id', 

       
    ];

    public function booking_details(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function room_type():BelongsTo{
        
        return $this->belongsTo(RoomType::class);
        
    }

   
   


    
}
