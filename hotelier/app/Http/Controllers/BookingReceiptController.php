<?php

namespace App\Http\Controllers;

use App\Models\BookingReceipt;
use App\Models\Room;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingReceiptController extends Controller
{
   
    public function store(Request $request)
    { 
       
        $found = false;
        $booking_receipt = BookingReceipt::join('bookings', 'booking_receipts.booking_id', '=', 'bookings.id')
        ->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
        ->where('booking_receipts.id', '=', $request->booking_receipt_id)
        ->select('booking_receipts.*', 'bookings.*', 'booking_details.*')
        ->get();
        $role_keys = $booking_receipt->pluck('role_user_key', 'id');
        $booking_nows = $booking_receipt->pluck('booking_now', 'id');
        $roomIds = $booking_receipt->pluck('room_id');
        $role_key_user = "";
        $cancel_status = "";
        $booking_now = "";
        $cancel_time_status = $booking_receipt->pluck('cancel_time_status','id');
        $current_now = Carbon::now();
    
        foreach ($booking_nows as $id => $now) {
            if($request->booking_now == $now){
                $found = true;
                $booking_now = Carbon::parse($now);
            }
        }
        
        foreach ($cancel_time_status as $id => $status) {
            if($request->cancel_time_status == $status){
                $found  = true;
                $cancel_status = $status;
            }
        }

        foreach ($role_keys as $id => $key) {
            if ($request->role_user_key == $key) {
                $found = true;
                $role_key_user = $key;
            }
        }

        if(!$found){}
        
        if($cancel_status != 1){
            if($current_now <= $booking_now){
                try{
           
                    $data_booking_receipt_update = ['cancel_time_status'=> 1];
                    $booking_receipt = BookingReceipt::findOrFail($request->booking_receipt_id);
                    $booking_receipt->update($data_booking_receipt_update);
                    
                    $data_room_update = ['status'=> 1, 'quantity'=>1];
                    
                    foreach ($roomIds as $index => $room_id) {
                        $rooms = Room::findOrFail($room_id);
                        $rooms->update($data_room_update);
                    }
                    
                    Log::info('Hủy đơn đặt phòng thành công!');
                    echo "<script> alert('Bạn đã hủy đơn đặt phòng thành công'); 
                    window.location.href = '".route('booking_details.index')."/".$role_key_user."'</script>";
        
                }catch(Exception $error){
        
                    Log::info('Hủy đơn đặt phòng thất bại! '.$error->getMessage());
                    echo "<script> alert('Bạn đã hủy đơn đặt phòng thất bại'); 
                    window.location.href = '".route('booking_details.index')."/".$role_key_user."'</script>";
                }
            }
            else{
                echo "<script> alert('Bạn đã quá hạn hủy đơn đặt phòng'); 
                window.location.href = '".route('booking_details.index')."/".$role_key_user."'</script>";
            }
           
        }
        else{
            echo "<script> alert('Bạn đã hủy đơn đặt phòng'); 
            window.location.href = '".route('booking_details.index')."/".$role_key_user."'</script>";
        }
        
    }

    public function destroy(string $id)
    {

    }
}
