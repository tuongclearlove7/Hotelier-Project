<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        
        
        'service_id',
        "booking_id",
       
    ];

    

    public function service():BelongsTo{
        
        return $this->BelongsTo(Service::class);
        
    }

    public function booking():BelongsTo{
        
        return $this->BelongsTo(Booking::class);
        
    }


}
