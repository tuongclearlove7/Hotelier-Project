<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingReceipt;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Booking_receiptController extends Controller
{
    public function index()
    {
        $data = [];
        $booking_receipts = BookingReceipt::with(['booking', 'bank'])->orderBy('id', 'asc')->get();
        $data["booking_receipts"] = $booking_receipts;
        return view('admins.booking_receipts.index', $data);
    }

 
    public function create()
    {
        $data = [];
    
        return view('admins.booking_receipts.create',$data);
    }

   

    
    public function show(string $id)
    {

    }

    
    public function edit(string $id)
    {
        $data=[];
        $booking_receipt = BookingReceipt::findOrFail($id);

        $data['booking_receipt'] = $booking_receipt;
        return view('admins.booking_receipts.edit', $data);
    }

   
    public function update(Request $request, string $id)
    {
        $booking_receipt = BookingReceipt::findOrFail($id);

        $dataUpdate = [
            "payment_status" => $request->payment_status,
            "cancel_time_status" => $request->cancel_time_status
        ];

        try {
             Log::info('Cập nhật 1 hóa đơn thành công!');
             $booking_receipt->update($dataUpdate);
             return redirect()->route('admin.booking_receipts.index')-> with('success', 'Cập nhật 1 hóa đơn thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.booking_receipts.index')-> with('error', 'Cập nhật 1 hóa đơn thất bại!');
        }
    }


    public function destroy(string $id)
    {
        $booking_receipt = BookingReceipt::findOrFail($id); 

        try {
            Log::info('Xóa 1 hóa đơn thành công!');
            $booking_receipt->delete();
            return redirect()->route('admin.booking_receipts.index')-> with('success', 'Xóa 1 hóa đơn thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.booking_receipts.index')-> with('error', 'Xóa 1 hóa đơn thất bại!');
        }
    }
}
