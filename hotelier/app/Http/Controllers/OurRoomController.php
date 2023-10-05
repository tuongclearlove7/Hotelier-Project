<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Http\Request;
use App\Models\BookingReceipt;
use App\Models\City;
use App\Models\Hotel;
use App\Models\HotelType;
use App\Models\Promotion;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\ServiceType;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OurRoomController extends Controller
{
    
    public function index()
    {
        $data = [];
        $services = Service::orderBy('id', 'asc')->paginate(6);
        $room_count = Room::count();
        $area_selects = Room::orderBy('id', 'asc')->get()->unique('area');  
        $view_selects = Room::orderBy('id', 'asc')->get()->unique('view');
        $hotel_selects = Room::orderBy('id', 'asc')->get()->unique('room_type_id');  
        $status_selects = Room::orderBy('id', 'asc')->get()->unique('status');  

        $rooms = Room::with('room_type');
        $cities = City::pluck('name', 'id');
        $hotels = Hotel::pluck('name', 'id');
        $room_prices = Room::pluck('price', 'id');
        $room_status = Room::pluck('status', 'id');
        $room_types = RoomType::get();
        $percents = (double) Promotion::max('reduciton');
        $giam_gia_thap = $percents - 0.20;
        $giam_gia_cao = $percents - 0.15;


        if (request()->get('room_type_id')) {

            $rooms->where('room_type_id', request()->get('room_type_id'));
        }

        if (request()->get('area')) {

            $rooms->where('area', request()->get('area'));
        }
        if (request()->get('view')) {

            $rooms->where('view', request()->get('view'));
        }
        if (request()->get('status')) {

            $rooms->where('status', request()->get('status'));
        }
        $rooms =  $rooms->orderBy('id','asc')->paginate(10);

        $data["services"] = $services;
        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
        $data["room_types"] = $room_types;
        $data["rooms"] = $rooms;
        $data["area_selects"] = $area_selects;
        $data["view_selects"] = $view_selects;
        $data["hotel_selects"] = $hotel_selects;
        $data["status_selects"] = $status_selects;
        $data["cities"] = $cities;
        $data["hotels"] = $hotels;
        $data["room_prices"] = $room_prices;
        $data["giam_gia_thap"] = $giam_gia_thap;
        $data["giam_gia_cao"] = $giam_gia_cao;

        return view("our_rooms.index",$data);
    }

 
    public function store(StoreBookingRequest $request)
    {
        $user_info = session('user_info');
        $promotion_ids = Promotion::where('code', $request->promotion_id)->get();
        $now = Carbon::now();
        $time_limit = Carbon::now();
        $checkin = date_create_from_format('m/d/Y g:i A', $request->checkin);
        $formattedCheckin = date_format($checkin, 'Y-m-d g:i');
        $promo_id = null;
        
        foreach ($promotion_ids as $id){
            $promo_id = $id->id;
            break;
        }

        try {

            $current_date = $now->addHours(12);
            $date_limited = $time_limit->addDays(7);

            if($formattedCheckin > $current_date){
                if($formattedCheckin < $date_limited){
                    
                    $userInfo = [

                        "fullname" =>  $request->fullname,
                        'email' => $request->email,
                        'phone' =>  $request->phone,
                        'address' => $request->address,
                        'checkin' => $formattedCheckin,
                        'checkout' => $request->checkout,
                        'num_guest' => $request->num_guest,
                        'note' => $request->node, 
                        'promotion_id' => $promo_id,
                    ];
    
    
                    $user_info = session('user_info');
                    $user_info = $userInfo;
                    session(['user_info' => $user_info]);
            
                    Log::info('Tiếp tục chọn phòng!');
                    
                    return redirect()->route('booking_details.index')-> with('success', 'Tiếp tục chọn phòng!');

                }else{
                    echo "<script> alert('Thời gian nhận phòng phải ít hơn 7 ngày !'); 
                    window.location.href = '".route('bookings.index')."'</script>";
                }
                
            }else{
                echo "<script> alert('Thời gian nhận phòng phải sau thời gian hiện tại ít nhất 12 tiếng !'); 
                window.location.href = '".route('bookings.index')."'</script>";
            }

        } catch (Exception $error) {

            Log::error($error->getMessage());
            return redirect()->route('bookings.index')-> with('error', 'Vui lòng nhập vào!!!');
        }
        
    }

    public function show(string $id)
    {
        $data=[];

        $roomType = RoomType::findOrFail($id);
        $percents = (double) Promotion::max('reduciton');
        $giam_gia_thap = $percents - 0.20;
        $giam_gia_cao = $percents - 0.15;

        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
        $data['roomType'] = $roomType;
        $data["giam_gia_thap"] = $giam_gia_thap;
        $data["giam_gia_cao"] = $giam_gia_cao;

        return view('our_rooms.show', $data);
    }

    public function room_detail($id)
    {
        $data=[];

     
        $room = RoomType::join('hotels', 'room_types.hotel_id', '=', 'hotels.id')
        ->join('rooms', 'room_types.id', '=', 'rooms.room_type_id')
        ->join('cities', 'room_types.city_id', '=', 'cities.id')
        ->where('rooms.id', $id)
        ->select([
            'cities.name as city_name',
            'hotels.name as hotel_name',
            'rooms.name as room_name',
            'rooms.id as room_id',
            'room_types.image as image_room',
            'rooms.description as description_room',
            'room_types.*',"rooms.*","hotels.*"
        ])->first();
        $percents = (double) Promotion::max('reduciton');
        $giam_gia_thap = $percents - 0.20;
        $giam_gia_cao = $percents - 0.15;
        $status_room = "";
        if($room->status==1) $status_room = '<i class="fa fa-circle text-success me-2"></i> Phòng trống';
        if($room->status==0) $status_room = '<i class="fa fa-circle text-danger me-2"></i> Hết phòng';

    
        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
        $data['room'] = $room;
        $data['status_room'] = $status_room;
        $data['giam_gia_cao'] = $giam_gia_cao;
        $data['giam_gia_thap'] = $giam_gia_thap;

        return view('our_rooms.room_detail', $data);

    }
}
