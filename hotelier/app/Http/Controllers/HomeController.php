<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingReceipt;
use App\Models\Hotel;
use App\Models\HotelType;
use App\Models\Promotion;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\ServiceType;
use DateTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        $data = [];
        $key_success = session('key_success');
        session()->forget('key_success');
        $hotel_types =  HotelType::orderBy('id', 'asc')->get();
        $hotels = Hotel::orderBy('id', 'asc')->get();
        $room_types = RoomType::where('id', '<=', 41)->orderBy('id', 'asc')->paginate(11);
        $rooms = Room::get();
        $service_types = ServiceType::where('id', '<=', 35)->orderBy('id', 'asc')->paginate(11);
        $checkouts = BookingReceipt::pluck("checkout","id");
        $count_room = Room::count();
        $count_hotel = Hotel::count();
        $count_customer = BookingReceipt::count();
        $current_date = new DateTime();
        $percents = (double) Promotion::max('reduciton');
        $giam_gia_thap = $percents - 0.10;
        $giam_gia_cao = $percents - 0.15;
        
        foreach($checkouts as $id => $time_checkout){

            $checkout = new DateTime($time_checkout);

            if($current_date >= $checkout){

                $roomIds = BookingDetail::join('bookings', 'booking_details.booking_id', '=', 'bookings.id')
                ->join('booking_receipts', 'booking_receipts.booking_id', '=', 'bookings.id')
                ->where('booking_receipts.checkout', 'LIKE', '%' . $time_checkout . '%')
                ->pluck('booking_details.room_id', "booking_details.id");

                foreach ($roomIds as $id => $value) {

                    $room = Room::findOrFail($value);
                    $dataUpdate = [
                        'quantity' => 1,
                        'status' => 1,
                    ];
                    $room->update($dataUpdate);
                }
            }
        }
        
        
        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
        $data['customers'] = $count_customer*2000;
        $data['room_numbers'] = $count_room*10;
        $data['number_hotel'] = $count_hotel*1;
        $data['staffs'] =  $count_room*20;
        $data["hotel_types"] = $hotel_types;
        $data["hotels"] = $hotels;
        $data["room_types"] = $room_types;
        $data["rooms"] = $rooms;
        $data["service_types"] = $service_types;
        $data["giam_gia_thap"] = $giam_gia_thap;
        $data["giam_gia_cao"] = $giam_gia_cao;

        return view('welcome', $data);
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

  
    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
       
    }
}
