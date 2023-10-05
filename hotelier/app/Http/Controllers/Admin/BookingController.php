<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
   
    public function index()
    {
        $data = [];
        $bookings = Booking::get();
        $data["bookings"] = $bookings;
        return view('admins.bookings.index', $data);
    }

  
    public function destroy(string $id)
    {
        $bookings = Booking::findOrFail($id); 

        try {
            Log::info('Xóa 1 booking thành công!');
            $bookings->delete();
            return redirect()->route('admin.bookings.index')-> with('success', 'Xóa 1 booking thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.bookings.index')-> with('error', 'Xóa 1 booking thất bại!');
        }
    }
}
