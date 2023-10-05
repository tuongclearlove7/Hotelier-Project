<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    
    public function index()
    {
        $data = [];
        $cities = City::get();
        $data["cities"] = $cities;
        return view('admins.cities.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        return view('admins.cities.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataSave = [
            'name' => $request->name,
        ];

        try {
            Log::info('Tạo 1 thành phố thành công!');
            City::create($dataSave);
            return redirect()->route('admin.cities.index')-> with('success', 'Tạo 1 thành phố thành công');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.cities.index')-> with('error', 'Tạo 1 thành phố thất bại');
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
        $city = City::findOrFail($id);
        $data['city'] = $city;
        return view('admins.cities.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);

        $dataUpdate = [
            'name' => $request->name,
        ];

        try {
             Log::info('Cập nhật 1 thành phố thành công!');
             $city->update($dataUpdate);
             return redirect()->route('admin.cities.index')-> with('success', 'Cập nhật 1 thành phố thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.cities.index')-> with('error', 'Cập nhật 1 thành phố thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id); 

        try {
            Log::info('Xóa 1 thành phố thành công!');
            $city->delete();
            return redirect()->route('admin.cities.index')-> with('success', 'Xóa 1 thành phố thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.cities.index')-> with('error', 'Xóa 1 thành phố thất bại!');
        }
    }
}
