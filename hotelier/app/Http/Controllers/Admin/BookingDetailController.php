<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingDetailController extends Controller
{
    public function index()
    {
        $data = [];
        $booking_details = BookingDetail::with(['booking','room'])->orderBy('id', 'asc')->get();
        $data["booking_details"] = $booking_details;
        return view('admins.booking_details.index', $data);
    }

 
    public function create()
    {
        $data = [];
    
        return view('admins.booking_details.create',$data);
    }

   

    
    public function show(string $id)
    {

    }

    
    public function edit(string $id)
    {
        $data=[];
        $booking_detail = BookingDetail::findOrFail($id);
        $rooms = Room::get();


        $data['booking_detail'] = $booking_detail;
        $data['rooms'] = $rooms;
        return view('admins.booking_details.edit', $data);
    }

   
    public function update(Request $request, string $id)
    {
        $booking_detail = BookingDetail::findOrFail($id);

        $dataUpdate = [
            "payment_status" => $request->payment_status,
            "cancel_time_status" => $request->cancel_time_status
        ];

        try {
             Log::info('Cập nhật 1 hóa đơn thành công!');
             $booking_detail->update($dataUpdate);
             return redirect()->route('admin.booking_details.index')-> with('success', 'Cập nhật 1 hóa đơn thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.booking_details.index')-> with('error', 'Cập nhật 1 hóa đơn thất bại!');
        }
    }


    public function destroy(string $id)
    {
        $booking_detail = BookingDetail::findOrFail($id); 

        try {
            Log::info('Xóa 1 hóa đơn thành công!');
            $booking_detail->delete();
            return redirect()->route('admin.booking_details.index')-> with('success', 'Xóa 1 hóa đơn thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.booking_details.index')-> with('error', 'Xóa 1 hóa đơn thất bại!');
        }
    }
}
