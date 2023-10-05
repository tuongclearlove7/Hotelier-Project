<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingReceiptRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingReceipt;
use App\Models\Promotion;
use App\Models\Room;
use App\Models\ServiceDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Bookingmail;
use App\Models\Bank;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
class PaymentController extends Controller
{
   
    public function index()
    {   
        $data=[];

        $user_info = session('user_info');
        $key_success = session('key_success');

        if($key_success!=null){
            
            $data['welcome'] = "Chào mừng đến với ";
            $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";
            $data["user_info"] = $user_info;
            $data["key_success"] = $key_success;
            
            return view('payments.index', $data);
        }
        else{

            echo "<script> alert('not found'); window.location.href = '".route('home')."'</script>";
        }
    
       
    }


    public function vnpay_payment(Request $request){

       
        $banks = Bank::pluck('name', 'id');
        $isvalid = false;
        $user_info = session('user_info');
        $sessionBookings = session('booking_info'); 
        $lists_ID = session("lists_ID");
        $current_now = Carbon::now();
        $current_now->addDays(2);

        if($sessionBookings != null){
        
            foreach ($banks as $id => $name){

                if($name == $request->bank_name){

                    Booking::create($user_info);
                    $bookingID = Booking::max('id');
                    $role_user_key = sha1($request->fullname)."_".$bookingID;
                    
                    if($lists_ID!=null){
                        foreach ($lists_ID as $service_id =>$value) {
                            ServiceDetail::create([
                                'service_id' => $value,
                                "booking_id"=>$bookingID,
                            ]);
                        }
                    }
                    
    
                    foreach ($sessionBookings as $booking){
                        if($booking['booking_id'] != null){
                            $room = Room::findOrFail($booking['room_id']);
                            $dataUpdate = [
                                'quantity' => 0,
                                'status' => 0,
                            ];
                            $room->update($dataUpdate);
    
                            BookingDetail::create([
                                'room_id' => $booking['room_id'],
                                'booking_id' => $bookingID,
                            ]);
                        }else{
    
                            $room = Room::findOrFail($booking['room_id']);
                            $dataUpdate = [
                                'quantity' => 0,
                                'status' => 0,
                            ];
                            $room->update($dataUpdate);
    
                            BookingDetail::create([
                                'room_id' => $booking['room_id'],
                                'booking_id' => $bookingID,
                            ]);
                        }
                        
                    }
    
                    $receipt = [
                        'checkout' => $request->checkout,
                        'cancel_time_status' =>0,
                        'payment_status' =>0,
                        'number_card' =>null,
                        'expiry_date' =>null,
                        'total_money' =>$request->total_money,
                        'booking_now'=>$current_now,
                        'role_user_key'=>$role_user_key,
                        'payment_method_status'=>1,
                        'flag_status'=> 0,
                        'booking_id' =>$bookingID,
                        'bank_id' =>null,
    
                    ];
    
                    BookingReceipt::create($receipt);
                    $booking_Receipt_ID = BookingReceipt::max('id');
    
                    Log::info('Create successfully!');
                    
                    $name= $request->fullname;
                    $count_room = 'Số phòng bạn đã đặt là : ' .Booking::join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
                    ->where('booking_details.booking_id', $bookingID)->count();
                    $notifi_message = "Vui lòng bấm vào link này để kiểm tra chi tiết thông tin đặt phòng của bạn ".asset('booking_details'.'/'.$role_user_key);
                    $total_money = "Tổng số tiền bạn đã thanh toán ".$request->total_money. " VNĐ";
                    $check_in = "Thời gian nhận phòng " .Booking::where('id', $bookingID)->pluck('checkin');
                    $check_out = "Thời gian trả phòng " .BookingReceipt::where('id', $booking_Receipt_ID)->pluck('checkout');
                    $bookingInfos = Booking::join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
                    ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
                    ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
                    ->join('hotels', 'room_types.hotel_id', '=', 'hotels.id')
                    ->join('cities', 'room_types.city_id', '=', 'cities.id')
                    ->where('booking_details.booking_id', $bookingID)
                    ->select('hotels.address', 'hotels.name as hotel_name', 
                    'cities.name as city_name', 'rooms.name as room_name')
                    ->get();

                    $data = [
                        'name' => $name,
                        'bookingInfos' => $bookingInfos,
                        'notifi_message' => $notifi_message,
                        'total_money' => $total_money,
                        'count_room' => $count_room,
                        'check_in' => $check_in,
                        'check_out' => $check_out,
                    ];

                    
                    Log::info('Khách hàng gửi mail thành công ');
    
                    $isvalid = true;
    
                    if($bookingID !=null){
    
                        $bookingID = Booking::max('id')+1;
                    }else{
                        $bookingID = 1;
                    }
            
                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = "http://127.0.0.1:8888/booking_details/".$role_user_key;
                    $vnp_TmnCode = "4JJIX9CS"; 
                    $vnp_HashSecret = "UHNMXBRYNIOPARTEUYRWGOASWPXRNVMG"; 
                    $vnp_TxnRef = $booking_Receipt_ID; 
                    $vnp_OrderInfo = "Thanh toán đơn đặt phòng";
                    $vnp_OrderType = "billpayment";
                    $vnp_Amount = $request->total_money*100;
                    $vnp_Locale = "VN";
                    $vnp_BankCode = $request->bank_name;
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            
                    $inputData = array(

                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef,
               
                    );
            
                    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                        $inputData['vnp_BankCode'] = $vnp_BankCode;
                    }
                    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                    }
            
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                  
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        } else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }
            
                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    }
                    $returnData = array('code' => '00'
                        , 'message' => 'success'
                        , 'data' => $vnp_Url);
                    if (isset($_POST['redirect'])) {
    
                        header('Location: ' . $vnp_Url);
                        die();
                        
                    } else {
                        
                        return Response::json($returnData);
                    }
                }
            }

        }else{

            echo "<script> alert('Vui lòng chọn phòng trước khi thanh toán!'); 
            window.location.href = '".route('our_rooms.index')."'</script>";
        }
        if(!$isvalid){
            echo "<script> alert('Vui lòng chọn thẻ thanh toán!'); 
            window.location.href = '".route('booking_details.index')."'</script>";
        }
        

    }

    
    public function store(StoreBookingReceiptRequest $request)
    {

        $data=[];
        $user_info = session('user_info');
        $sessionBookings = session('booking_info'); 
        $lists_ID = session("lists_ID");
        $current_now = Carbon::now();
        $current_now->addDays(2);
       
        if($sessionBookings !=null){

            try{
                Booking::create($user_info);
                $bookingID = Booking::max('id');
                $role_user_key = sha1($request->fullname)."_".$bookingID;
                
                if($lists_ID!=null){
                    foreach ($lists_ID as $service_id =>$value) {
                        ServiceDetail::create([
                            'service_id' => $value,
                            "booking_id"=>$bookingID,
                        ]);
                    }
                }
               

                foreach ($sessionBookings as $booking){
                    if($booking['booking_id'] != null){
                        $room = Room::findOrFail($booking['room_id']);
                        $dataUpdate = [
                            'quantity' => 0,
                            'status' => 0,
                        ];
                        $room->update($dataUpdate);

                        BookingDetail::create([
                            'room_id' => $booking['room_id'],
                            'booking_id' => $bookingID,
                        ]);
                    }else{

                        $room = Room::findOrFail($booking['room_id']);
                        $dataUpdate = [
                            'quantity' => 0,
                            'status' => 0,
                        ];
                        $room->update($dataUpdate);

                        BookingDetail::create([
                            'room_id' => $booking['room_id'],
                            'booking_id' => $bookingID,
                        ]);
                    }
                    
                }

                $receipt = [
                    'checkout' => $request->checkout,
                    'cancel_time_status' =>0,
                    'payment_status' =>0,
                    'number_card' =>$request->number_card,
                    'expiry_date' =>$request->expiry_date,
                    'total_money' =>$request->total_money,
                    'booking_now'=>$current_now,
                    'role_user_key'=>$role_user_key,
                    'payment_method_status'=>0,
                    'flag_status'=> 1,
                    'booking_id' =>$bookingID,
                    'bank_id' =>$request->bank_id,
    
                ];

                BookingReceipt::create($receipt);
                $booking_Receipt_ID = BookingReceipt::max('id');

                Log::info('Create successfully!');
                
                $customer_email = $request->email;
                $name= $request->fullname;
                $count_room = 'Số phòng bạn đã đặt là : ' .Booking::join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
                ->where('booking_details.booking_id', $bookingID)->count();
                $notifi_message = "Vui lòng bấm vào link này để kiểm tra chi tiết thông tin đặt phòng của bạn ".asset('booking_details'.'/'.$role_user_key);
                $total_money = "Tổng số tiền bạn phải thanh toán ".$request->total_money. " VNĐ";
                $check_in = "Thời gian nhận phòng " .Booking::where('id', $bookingID)->pluck('checkin');
                $check_out = "Thời gian trả phòng " .BookingReceipt::where('id', $booking_Receipt_ID)->pluck('checkout');
                $bookingInfos = Booking::join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
                ->join('booking_receipts', 'bookings.id', '=', 'booking_receipts.booking_id')
                ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
                ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
                ->join('hotels', 'room_types.hotel_id', '=', 'hotels.id')
                ->join('cities', 'room_types.city_id', '=', 'cities.id')
                ->where('booking_receipts.role_user_key', $role_user_key)
                ->select('bookings.*','booking_receipts.*','booking_details.*',
                'booking_receipts.id as booking_receipt_id',
                'hotels.address', 'hotels.name as hotel_name', 
                'cities.name as city_name', 'rooms.name as room_name')
                ->get();

                $data = [
                    'name' => $name,
                    'bookingInfos' => $bookingInfos,
                    'notifi_message' => $notifi_message,
                    'total_money' => $total_money,
                    'count_room' => $count_room,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                ];

                $data = [
                    'notifi_message'=>$notifi_message,
                    'ma_hoadon'=> $role_user_key,
                    'bookingInfos'=>$bookingInfos,
                ];

                Mail::to($customer_email)->send(new BookingMail($data));
                Log::info('Khách hàng gửi mail thành công ');
               
                session()->forget('room_info');
                session()->forget('booking_info');
                session()->forget('lists_ID');

                echo "<script> alert('Bạn đã đặt phòng thành công! Lưu ý hủy đơn đặt phòng trong 48h'); 
                window.location.href = '".route('booking_details.index')."/" .$role_user_key ."'</script>";
            
            }catch(Exception $error){

                Log::error('Đặt phòng thất bại ' .$error->getMessage());
                return redirect()->route('booking_details.index')->with('failed', 'Thanh toán thất bại');
            }
        }else{

            echo "<script> alert('Vui lòng chọn phòng trước khi thanh toán!'); 
            window.location.href = '".route('our_rooms.index')."'</script>";
        }
        

    }


}
