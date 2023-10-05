<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBookingReceiptRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Mail\ContactMail;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingReceipt;
use App\Models\Promotion;
use App\Models\Room;
use App\Models\ServiceDetail;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
   
    public function index()
    {
        $data=[];
        $data['welcome'] = "Chào mừng đến với ";
        $data['description'] = "Tại đây, chúng tôi tự hào giới thiệu đến bạn một trải nghiệm đẳng cấp và thoải mái trong việc tìm kiếm và đặt phòng khách sạn lý tưởng cho chuyến du lịch của bạn. Với một kho lưu trữ đa dạng về các lựa chọn phòng và dịch vụ tiện ích, chúng tôi cam kết mang đến cho bạn những giây phút thư giãn và trọn vẹn.";

        return view('contacts.index', $data);
        
    }

   
    public function store(Request $request)
    {

        try{

            Mail::to('lol00sever@gmail.com')->send(new ContactMail($request));
            Log::info('Khách hàng gửi mail thành công ');

            echo "<script> alert('Chúng tôi đã nhận được tin nhắn của bạn liên hệ tổng đài 1900100 để biết thêm thông tin chi tiết ^^'); 
            window.location.href = '".route('contacts.index')."'</script>";
        }catch(Exception $error){
            Log::info('Khách hàng gửi mail k thành công ' .$error->getMessage());

            return redirect()->route('contacts.index')->with('failed', 'Gửi mail k thành công');
        }
    }

  
 
}
