<?php

namespace App\Http\Middleware;

use App\Models\BookingReceipt;
use Closure;
use Exception;
use App\Mail\Bookingmail;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Check_role_key
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
    
        $role_keys = BookingReceipt::pluck('role_user_key', 'id');
        $role_key = $request->route('id');
        $found = false;

        if($role_keys != null){
            
            foreach($role_keys as $key_id => $key){

                if ($key == $role_key) {
       
                    $bookingInfos = Booking::join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
                    ->join('booking_receipts', 'bookings.id', '=', 'booking_receipts.booking_id')
                    ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
                    ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
                    ->join('hotels', 'room_types.hotel_id', '=', 'hotels.id')
                    ->join('cities', 'room_types.city_id', '=', 'cities.id')
                    ->where('booking_receipts.role_user_key', $key)
                    ->select('bookings.*','booking_receipts.*','booking_details.*',
                    'booking_receipts.id as booking_receipt_id',
                    'hotels.address', 'hotels.name as hotel_name', 
                    'cities.name as city_name', 'rooms.name as room_name')
                    ->get();

                    foreach($bookingInfos as $bookingInfo){

                        if($bookingInfo->payment_method_status != 0){

                            if($bookingInfo->cancel_time_status != 1){

                                if($bookingInfo->flag_status != 1){
                                    
                                    $notifi_message = "Vui lòng bấm vào link này để kiểm tra chi tiết 
                                    thông tin đặt phòng của bạn ".asset('booking_details'.'/'.$key);
                                    $found = true;
                                    $data = [];
                                    $customer_email = '';
                
                                    $data = [
                                        'notifi_message'=>$notifi_message,
                                        'ma_hoadon'=> $key,
                                        'bookingInfos'=>$bookingInfos,
                                    ];
                
                                    foreach($bookingInfos as $bookingInfo){
                                        $customer_email = $bookingInfo->email;
                                        $Booking_Receipt = BookingReceipt::findOrFail($bookingInfo->booking_receipt_id);
                                        $dataUpdate = [
                                            'payment_status' => 1,
                                            'flag_status'=>1
                                        ];
                                        $Booking_Receipt->update($dataUpdate);
                                        break;
                                    }
                
                                    Mail::to($customer_email)->send(new BookingMail($data));
                                    session()->forget('room_info');
                                    session()->forget('booking_info');
                                    session()->forget('lists_ID');
                                    Log::info($found);

                                }
                                else{
                                    $found = true;
                                }

                            }
                            else{
                                $found = true;
                            }
                            
                        }else{

                            $found = true;
                            session()->forget('room_info');
                            session()->forget('booking_info');
                            session()->forget('lists_ID');
                            Log::info($found);
                           
                        }
                        break;
                    }

                }    
            }
            if(!$found){

                return redirect()->route('booking_details.index')->with('error', 'Không tìm thấy!!!');
            }
        }else{

            return redirect()->route('booking_details.index')->with('error', 'Not found');
        }


        return $next($request);
    }
}
