<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotelTypeController extends Controller
{
    public function index()
    {
        $data = [];
        $hotel_types = HotelType::get();
        $data["hotel_types"] = $hotel_types;
        return view('admins.hotel_types.index', $data);
    }

    public function create()
    {
        $data = [];
        return view('admins.hotel_types.create',$data);
    }

  
    public function store(Request $request)
    {
        $dataSave = [
            'name' => $request->name,
            'star' => $request->star,
        ];

        try {
            Log::info('Tạo 1 kiểu khách sạn thành công!');
            HotelType::create($dataSave);
            return redirect()->route('admin.hotel_types.index')-> with('success', 'Tạo 1 kiểu khách sạn thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.hotel_types.index')-> with('error', 'Tạo 1 kiểu khách sạn thất bại');
        }
    }

    
    public function show(string $id)
    {

    }

  
    public function edit(string $id)
    {
        $data=[];
        $hotel_type = HotelType::findOrFail($id);
        $star_hotels = HotelType::pluck('star','id');
        
        $data['hotel_type'] = $hotel_type;
        $data['star_hotels'] = $star_hotels;
        return view('admins.hotel_types.edit', $data);
    }

   
    public function update(Request $request, string $id)
    {
        $hotel_type = HotelType::findOrFail($id);

        $dataUpdate = [
            'name' => $request->name,
            'star' => $request->star,
        ];

        try {
             Log::info('Cập nhật 1 kiểu khách sạn thành công!');
             $hotel_type->update($dataUpdate);
             return redirect()->route('admin.hotel_types.index')-> with('success', 'Cập nhật 1 kiểu khách sạn thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.hotel_types.index')-> with('error', 'Cập nhật 1 kiểu khách sạn thất bại!');
        }
    }

  
    public function destroy(string $id)
    {
        $hotel_type = HotelType::findOrFail($id); 

        try {
            Log::info('Xóa 1 kiểu khách sạn thành công!');
            $hotel_type->delete();
            return redirect()->route('admin.hotel_types.index')-> with('success', 'Xóa 1 kiểu khách sạn thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.hotel_types.index')-> with('error', 'Xóa 1 kiểu khách sạn thất bại!');
        }
    }
}
