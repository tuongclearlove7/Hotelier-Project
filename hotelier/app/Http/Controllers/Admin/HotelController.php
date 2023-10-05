<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hotel;
use App\Models\HotelType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    public function index()
    {
        $data = [];
        $hotels = Hotel::get();
        $data["hotels"] = $hotels;
        return view('admins.hotels.index', $data);
    }

   
    public function create()
    {
        $data = [];
        $hotel_types = HotelType::pluck('name','id');
        $cities = City::pluck('name','id');
        $data["hotel_types"] = $hotel_types;
        $data["cities"] = $cities;

        return view('admins.hotels.create',$data);
    }

  
    public function store(Request $request)
    {
        
        $dataSave = [
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'hotel_type_id' => $request->hotel_type_id,
            'city_id' => $request->city_id,
            'num' => $request->num,
        ];

        try {
            Log::info('Tạo 1 khách sạn thành công!');
            Hotel::create($dataSave);
            return redirect()->route('admin.hotels.index')-> with('success', 'Tạo 1 khách sạn thành công');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.hotels.index')-> with('error', 'Tạo 1 khách sạn thất bại');
        }
    }

   
    public function show(string $id)
    {

    }


    public function edit(string $id)
    {
        $data=[];
        $hotel = Hotel::findOrFail($id);
        $hotel_types = HotelType::pluck('name','id');
        $cities = City::pluck('name','id');

        $data["hotel_types"] = $hotel_types;
        $data["cities"] = $cities;
        $data['hotel'] = $hotel;
        return view('admins.hotels.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $hotel = Hotel::findOrFail($id);

        $dataUpdate = [
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'hotel_type_id' => $request->hotel_type_id,
            'city_id' => $request->city_id,
            'image_hotel' => $request->image_hotel,
        ];

        try {
             Log::info('Cập nhật 1 khách sạn thành công!');
             $hotel->update($dataUpdate);
             return redirect()->route('admin.hotels.index')-> with('success', 'Cập nhật 1 khách sạn thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.hotels.index')-> with('error', 'Cập nhật 1 khách sạn thất bại!');
        }
    }

   
    public function destroy(string $id)
    {
        $hotel = Hotel::findOrFail($id); 

        try {
            Log::info('Xóa 1 khách sạn thành công!');
            $hotel->delete();
            return redirect()->route('admin.hotels.index')-> with('success', 'Xóa 1 khách sạn thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.hotels.index')-> with('error', 'Xóa 1 khách sạn thất bại!');
        }
    }
}
