<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Hotel;
use App\Models\HotelType;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class HotelController extends Controller
{

    public function count_room($id){

        $count = Hotel::join('room_types', 'hotels.id', '=', 'room_types.hotel_id')
        ->join('rooms', 'room_types.id', '=', 'rooms.room_type_id')
        ->where('hotels.id', $id)
        ->count();

        return $count;  
    }

    public function index()
    {
        
        $data = [];
        $hotel_types = HotelType::query();
        $hotels = Hotel::with("hotel_type")->orderBy('id', 'asc')->paginate(6);
        $room_types= RoomType::orderBy('id', 'asc')->paginate(6);
        $hotelController = new HotelController();
        $city_ids = City::pluck("name","id");

        if (request()->has('hotel_type_id') && request()->get('hotel_type_id') != "0") {
            
            $hotel_types->where('id', request()->get('hotel_type_id'));
        }

        $hotel_types =  $hotel_types->orderBy('id', 'asc')->paginate(10);

        if (request()->get('city_id')) {
            $hotel_types = HotelType::join('hotels', 'hotel_types.id', '=', 'hotels.hotel_type_id')
            ->select('hotel_types.*')
            ->where('hotels.city_id', request()->get('city_id'))
            ->orderBy('hotel_types.id', 'asc')
            ->distinct()
            ->paginate(10);

        }

        if(request()->get('keyword')){
            $hotel_types = HotelType::join('hotels', 'hotel_types.id', '=', 'hotels.hotel_type_id')
            ->where('hotels.name', request()->get('keyword'))
            ->select('hotel_types.*') 
            ->orderBy('hotel_types.id', 'asc')
            ->paginate(10);
        }

        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
        $data['hotel_types'] = $hotel_types;
        $data['hotels'] = $hotels;
        $data['room_types'] = $room_types;
        $data['city_ids'] = $city_ids;


        return view('hotels.index', $data);
    }

  
    public function show(string $id)
    {
        $data=[];

        $hotelType = HotelType::findOrFail($id);
        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
        $data['hotelType'] = $hotelType;
        
        return view('hotels.show', $data);

    }


    public function hotel_detail($id)
    {
        $data=[];

        $hotel = Hotel::findOrFail($id);
        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
        $data['hotel'] = $hotel;
       
        return view('hotels.hotel_detail', $data);

    }

   
   
}
