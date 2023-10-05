<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class HotelType extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'name', 
        'star', 
       
    ];

    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }

  

}
