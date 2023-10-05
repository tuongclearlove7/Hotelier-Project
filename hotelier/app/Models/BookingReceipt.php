<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class BookingReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'checkout', 
        'cancel_time_status', 
        'payment_status', 
        'number_card',
        'expiry_date',
        'total_money',
        'booking_now',
        'role_user_key',
        'payment_method_status',
        'flag_status',
        'booking_id', 
        'bank_id',
        
       
    ];

    

    public function bank():BelongsTo{
        
        return $this->belongsTo(Bank::class);
        
    }

    
    public function booking():BelongsTo{
        
        return $this->belongsTo(Booking::class);
        
    }
}
