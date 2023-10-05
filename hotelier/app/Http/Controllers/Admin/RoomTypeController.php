<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hotel;
use App\Models\RoomType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoomTypeController extends Controller
{
    public function index()
    {
        $data = [];
        $room_types = RoomType::get();
        $data["room_types"] = $room_types;
        return view('admins.room_types.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $hotels = Hotel::pluck('name','id');
        $cities = City::pluck('name','id');

        $data['hotels'] = $hotels;
        $data['cities'] = $cities;

        return view('admins.room_types.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataSave = [
            'name' => $request->name,
            'image'=> $request->image,
            'hotel_id'=> $request->hotel_id,
            'city_id'=> $request->city_id,
        ];

        try {
            Log::info('Tạo 1 kiểu phòng thành công!');
            RoomType::create($dataSave);
            return redirect()->route('admin.room_types.index')-> with('success', 'Tạo 1 kiểu phòng thành công');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.room_types.index')-> with('error', 'Tạo 1 kiểu phòng thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=[];
        $room_type = RoomType::findOrFail($id);
        $hotels = Hotel::pluck('name','id');
        $cities = City::pluck('name','id');

        $data['room_type'] = $room_type;
        $data['hotels'] = $hotels;
        $data['cities'] = $cities;

        return view('admins.room_types.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room_type = RoomType::findOrFail($id);
        

        $dataUpdate = [
            'name' => $request->name,
            'image'=> $request->image,
            'hotel_id'=> $request->hotel_id,
            'city_id'=> $request->city_id,
        ];

        try {
             Log::info('Cập nhật 1 kiểu phòng thành công!');
             $room_type->update($dataUpdate);
             return redirect()->route('admin.room_types.index')-> with('success', 'Cập nhật 1 kiểu phòng thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.room_types.index')-> with('error', 'Cập nhật 1 kiểu phòng thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room_type = RoomType::findOrFail($id); 

        try {
            Log::info('Xóa 1 kiểu phòng thành công!');
            $room_type->delete();
            return redirect()->route('admin.room_types.index')-> with('success', 'Xóa 1 kiểu phòng thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.room_types.index')-> with('error', 'Xóa 1 kiểu phòng thất bại!');
        }
    }
}
