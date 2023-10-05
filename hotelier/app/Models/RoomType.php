<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name', 
        'num_bed', 
        'num_bath_room', 
        'image',  
        'capactity', 
        'view', 
        'area',
        'hotel_id', 
        'city_id', 
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }


    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
