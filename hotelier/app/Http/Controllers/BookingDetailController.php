<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingReceipt;
use App\Models\Promotion;
use App\Models\Room;
use App\Models\Service;
use App\Models\ServiceDetail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;

class BookingDetailController extends Controller
{
  
    public function index()
    {   
        $data=[];
        
        $user_info = session('user_info');
        $selectRooms = session('room_info');
        $sessionBookings = session('booking_info');
        $banks = Bank::pluck('name','id');
        $services = Service::orderBy('id', 'asc')->paginate(6);
        $reduciton = 0;
        if($user_info!=null){
            $reduciton = Promotion::where('id', $user_info['promotion_id'])->value('reduciton');
        }

        if($user_info != null){

                $so_ngay_o = 0;
          
                if ($user_info['checkout'] >= 21) {

                    $so_ngay_o = $reduciton + 0.50;

                } else if ($user_info['checkout'] >= 14) {

                    $so_ngay_o = $reduciton + 0.20;

                } else {

                    $so_ngay_o = $reduciton + 0.10;
                }
                    

                $data['welcome'] = "Chào mừng đến với ";
                $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
                $data["user_info"] = $user_info;
                $data["selectRooms"] = $selectRooms;
                $data["sessionBookings"] = $sessionBookings;
                $data["banks"] = $banks;
                $data["services"] = $services;
                $data["reduciton"] = $reduciton;
                $data["so_ngay_o"] = $so_ngay_o;

                return view('booking_details.index', $data);
           
        }else{
            echo "<script> alert('Vui lòng nhập thông tin để booking!'); 
            window.location.href = '".route('bookings.index')."'</script>";
        }

       
    }

    
    public function create()
    {
   
    }

    public function store(Request $request)
    {
        $user_info = session('user_info');
        
        

        if($user_info!= null){

            if($request->status != 0){

                $room = Room::findOrFail($request->room_id);
                $selectRooms = session('room_info');
                $InSelect_Room = collect($selectRooms)->firstWhere('room_id', $request->room_id);
                $sessionBookings = session('booking_info');
                $roomInSelect = collect($sessionBookings)->firstWhere('room_id', $request->room_id);
                $booking_id = Booking::max('id');
    
    
                if($booking_id!=null){
                    $booking_id = Booking::max('id');
                }else{
                    $booking_id = null;
                }
                
                if (!empty($roomInSelect)) {
        
                    $bookingInfo = [
                        'room_id' => $request->room_id,
                        'booking_id' =>  $booking_id+1,
                    ]; 
        
                }
                else{
        
                    $bookingInfo = [
                        'room_id' => $request->room_id,
                        'booking_id' => $booking_id,
                    ]; 
        
                }
    
        
                if (empty($InSelect_Room)) {
    
                    $roomInfo = [
                        "name" =>  $request->name,
                        'quantity' => 1,
                        'price' =>  $request->price,
                        'status' => $request->status,
                        'area'=> $request->area,
                        'address'=> $request->address,
                        'name_hotel'=> $request->name_hotel,
                        'name_city'=> $request->name_city,
                        'num_bed'=> $request->num_bed,
                        'num_bath_room'=> $request->num_bath_room,
                        'capacity'=> $request->capacity,
                        'room_id'=> $request->room_id,
                    ];
    
                    $selectRooms[$request->room_id] = $roomInfo;
                    session(['room_info' => $selectRooms]);
    
                    $sessionBookings[$request->room_id] = $bookingInfo;
                    session(['booking_info' => $sessionBookings]);
            
                    Log::info('create successfully!');
            
                    return redirect()->route('booking_details.index')->with('success', 'Add rooms successful.');
                
                } 
                else {
                    $quantityInSelect = $InSelect_Room['quantity']+1;
                    if($quantityInSelect > 1){
                        
                        echo "<script> alert('Chỉ có 1 phòng này vui lòng chọn phòng khác!'); 
                        window.location.href = '".route('our_rooms.index')."'</script>";
                    }
                }

            }
            else{
                echo "<script> alert('Phòng này đã hết vui lòng chọn phòng khác !'); 
                window.location.href = '".route('our_rooms.index')."'</script>";
            }
        }
        else{
            echo "<script> alert('Vui lòng nhập thông tin để booking!'); 
            window.location.href = '".route('bookings.index')."'</script>";

        }

    }

    public function remove($room_id)
    {
        $lists_ID = session("lists_ID");
        session()->forget('lists_ID');
       
        $room = Room::findOrFail($room_id);
        $selectRooms = session('room_info');
        $sessionBookings = session('booking_info');
        
    
        foreach ($sessionBookings as $key => $booking) {
            if ($booking['room_id'] == $room_id) {
                unset($sessionBookings[$key]);
                break;
            }
        }

        foreach ($selectRooms as $key => $room) {
            if ($room['room_id'] == $room_id) {
                unset($selectRooms[$key]);
                break;
            }
        }
        session(['room_info' => $selectRooms]);
        session(['booking_info' => $sessionBookings]);


        return redirect()->back()->with('success', 'delete successfully');

    }


    public function show(string $id)
    {
       
        $str='';
        $pmt_stt = "";
        $index = 1;
        $service_details = null;
        $booking_receipt = BookingReceipt::select('booking_receipts.*','bookings.*','booking_receipts.id as booking_receipt_id')
        ->join('bookings', 'booking_receipts.booking_id', '=', 'bookings.id')
        ->where('booking_receipts.role_user_key', $id)
        ->first();
        $count_room_booking = BookingReceipt::join('bookings', 'booking_receipts.booking_id', '=', 'bookings.id')
        ->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
        ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
        ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
        ->join('hotels', 'room_types.hotel_id','=','hotels.id')
        ->join('cities','hotels.city_id','=','cities.id')
        ->where('booking_receipts.role_user_key', '=', $id)
        ->select('booking_receipts.*', 'bookings.*', 
        'booking_details.*', 'rooms.*', 'room_types.*'
        ,'hotels.name as hotel_name','cities.name as city_name',
        'hotels.address as hotel_address')
        ->count();
        
        $booking_receipts = BookingReceipt::join('bookings', 'booking_receipts.booking_id', '=', 'bookings.id')
        ->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
        ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
        ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
        ->join('hotels', 'room_types.hotel_id', '=', 'hotels.id')
        ->join('cities', 'room_types.city_id', '=', 'cities.id')
        ->join('service_details', 'bookings.id', '=', 'service_details.booking_id')
        ->join('services', 'service_details.service_id', '=', 'services.id')
        ->where('booking_receipts.role_user_key', '=', $id)
        ->select('booking_receipts.*', 'bookings.*', 
        'booking_details.*', 'rooms.*', 'room_types.*',
        'hotels.name as hotel_name', 'cities.name as city_name', 
        'services.name as service_name', 'hotels.address as hotel_address')
        ->distinct()->paginate($count_room_booking);
        

        if($booking_receipts->count() != 0){
            $booking_receipts = BookingReceipt::join('bookings', 'booking_receipts.booking_id', '=', 'bookings.id')
            ->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->join('hotels', 'room_types.hotel_id', '=', 'hotels.id')
            ->join('cities', 'room_types.city_id', '=', 'cities.id')
            ->join('service_details', 'bookings.id', '=', 'service_details.booking_id')
            ->join('services', 'service_details.service_id', '=', 'services.id')
            ->where('booking_receipts.role_user_key', '=', $id)
            ->select('booking_receipts.*', 'bookings.*', 
            "booking_receipts.id as booking_receipt_id",
            'booking_details.*', 'rooms.*', 'room_types.*',
            'hotels.name as hotel_name', 'cities.name as city_name', 
            'services.name as service_name', 'hotels.address as hotel_address')
            ->distinct()->paginate($count_room_booking);

            $service_details = ServiceDetail::join('bookings', 'service_details.booking_id', '=', 'bookings.id')
            ->join('booking_receipts', 'booking_receipts.booking_id', '=', 'bookings.id')
            ->join('services', 'service_details.service_id', '=', 'services.id')
            ->where('booking_receipts.role_user_key', '=', $id)
            ->select('service_details.*', 'services.name as service_name')
            ->get();

            if($service_details !=null){
                foreach ($service_details as $service_detail){
                    $str = $str .$service_detail->service_name. ", ";
                }
                $str = 'Dịch vụ bạn đã chọn '.$str;
            }
            else{
                $str = 'Không chọn dịch vụ';
            }
                

            $payment_status = $booking_receipts->pluck("payment_status","booking_receipt_id");
            
            foreach($payment_status as $id => $status){
                $pmt_stt = $status;
            }

        }else{                        

            $booking_receipts = BookingReceipt::join('bookings', 'booking_receipts.booking_id', '=', 'bookings.id')
            ->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->join('hotels', 'room_types.hotel_id','=','hotels.id')
            ->join('cities','hotels.city_id','=','cities.id')
            ->where('booking_receipts.role_user_key', '=', $id)
            ->select('booking_receipts.*', 'bookings.*', 
            'booking_details.*', 'rooms.*', 'room_types.*',
            "booking_receipts.id as booking_receipt_id",
            'hotels.name as hotel_name','cities.name as city_name',
            'hotels.address as hotel_address')
            ->paginate($count_room_booking);
            
            $payment_status = $booking_receipts->pluck("payment_status","booking_receipt_id");
            foreach($payment_status as $id => $status){
                $pmt_stt = $status;
            }
        }
        
        
        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
        $data['booking_receipts'] = $booking_receipts;
        $data['service_details'] = $service_details;       
        $data['booking_receipt'] = $booking_receipt;
        $data['count_room_booking'] = $count_room_booking;
        $data['index'] = $index;
        $data['pmt_stt'] = $pmt_stt;  
        $data['str'] = $str;  

     
        return view("booking_details.show", $data);
    }
            

        
    

}
