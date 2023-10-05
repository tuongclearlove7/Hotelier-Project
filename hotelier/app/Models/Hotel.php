<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name', 
        'address', 
        'description', 
        'hotel_type_id',  
        'city_id'
       
    ];

    public function roomtypes(): HasMany
    {
        return $this->hasMany(RoomType::class);
    }

    public function hotel_type():BelongsTo{
        
        return $this->belongsTo(HotelType::class);
        
    }

    public function city():BelongsTo{
        
        return $this->belongsTo(City::class);
        
    }
}
