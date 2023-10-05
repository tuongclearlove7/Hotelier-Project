<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'fullname', 
        'email', 
        'phone', 
        'address', 
        'checkin', 
        'num_guest',
        'note', 
        'promotion_id', 

    ];

    // public function bookingreceipts(): HasMany
    // {
    //     return $this->hasMany(BookingReceipt::class);
    // }

    public function servicedetails(): HasMany
    {
        return $this->hasMany(ServiceDetail::class);
    }

    public function bookingdetails(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function promotion():BelongsTo{
        
        return $this->belongsTo(Promotion::class);
        
    }
   
}
