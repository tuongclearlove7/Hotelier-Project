<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'name',
       
    ];


    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }

    public function room_types(): HasMany
    {
        return $this->hasMany(RoomType::class);
    }
}
