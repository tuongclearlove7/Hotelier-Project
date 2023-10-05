<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    public function index()
    {
        $data = [];
        $rooms = Room::get();
        $data["rooms"] = $rooms;
        return view('admins.rooms.index', $data);
    }

 
    public function create()
    {
        $data = [];
        $room_types = RoomType::get();
        $data['room_types'] = $room_types;

        return view('admins.rooms.create',$data);
    }

    public function store(Request $request)
    {
        $dataSave = [
            'name' => $request->name,
            'status' => $request->status,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'num_bed'=> $request->num_bed,
            'num_bath_room'=> $request->num_bath_room,
            'capactity'=> $request->capactity,
            'area'=> $request->area,
            'view'=> $request->view,
            'room_type_id' => $request->room_type_id,



        ];

        try {
            Log::info('Tạo 1 phòng thành công!');
            Room::create($dataSave);
            return redirect()->route('admin.rooms.index')-> with('success', 'Tạo 1 phòng thành công');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.rooms.index')-> with('error', 'Tạo 1 phòng thất bại');
        }
    }

    
    public function show(string $id)
    {

    }

    
    public function edit(string $id)
    {
        $data=[];
        $room = Room::findOrFail($id);
        $room_types = RoomType::get();

        $data['room_types'] = $room_types;
        $data['room'] = $room;
        return view('admins.rooms.edit', $data);
    }

   
    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);

        $dataUpdate = [
            'name' => $request->name,
            'status' => $request->status,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'num_bed'=> $request->num_bed,
            'num_bath_room'=> $request->num_bath_room,
            'capactity'=> $request->capactity,
            'area'=> $request->area,
            'view'=> $request->view,
            'room_type_id' => $request->room_type_id,

        ];

        try {
             Log::info('Cập nhật 1 phòng thành công!');
             $room->update($dataUpdate);
             return redirect()->route('admin.rooms.index')-> with('success', 'Cập nhật 1 phòng thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.rooms.index')-> with('error', 'Cập nhật 1 phòng thất bại!');
        }
    }


    public function destroy(string $id)
    {
        $room = Room::findOrFail($id); 

        try {
            Log::info('Xóa 1 phòng thành công!');
            $room->delete();
            return redirect()->route('admin.rooms.index')-> with('success', 'Xóa 1 phòng thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.rooms.index')-> with('error', 'Xóa 1 phòng thất bại!');
        }
    }
}
