<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingReceipt;
use App\Models\HotelType;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\ServiceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    private $c = 0;
    public function index()
    {

        $data = [];

        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";

        return view("bookings.index",$data);
            
        
    }


    public function create()
    {
        
    }

  
    public function store(Request $request)
    {
        

    }

    

    public function show(string $id)
    {
     
    }

   
    public function edit(string $id)
    {
        
    }

   
    public function update(Request $request, int $id)
    {
        

    }

    
    public function destroy(int $id)
    {
        
    }


    
}
