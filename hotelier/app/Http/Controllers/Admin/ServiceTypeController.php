<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceTypeController extends Controller
{
    public function index()
    {
        $data = [];
        $service_types = ServiceType::get();
        $data["service_types"] = $service_types;
        return view('admins.service_types.index', $data);
    }

    public function create()
    {
        $data = [];
        return view('admins.service_types.create',$data);
    }

  
    public function store(Request $request)
    {
        $dataSave = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        try {
            Log::info('Tạo 1 kiểu dịch vụ thành công!');
            ServiceType::create($dataSave);
            return redirect()->route('admin.service_types.index')-> with('success', 'Tạo 1 kiểu dịch vụ thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.service_types.index')-> with('error', 'Tạo 1 kiểu dịch vụ thất bại');
        }
    }

    
    public function show(string $id)
    {

    }

  
    public function edit(string $id)
    {
        $data=[];
        $service_type = ServiceType::findOrFail($id);
        
        $data['service_type'] = $service_type;
        return view('admins.service_types.edit', $data);
    }

   
    public function update(Request $request, string $id)
    {
        $service_type = ServiceType::findOrFail($id);

        $dataUpdate = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        try {
             Log::info('Cập nhật 1 kiểu dịch vụ thành công!');
             $service_type->update($dataUpdate);
             return redirect()->route('admin.service_types.index')-> with('success', 'Cập nhật 1 kiểu dịch vụ thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.service_types.index')-> with('error', 'Cập nhật 1 kiểu dịch vụ thất bại!');
        }
    }

  
    public function destroy(string $id)
    {
        $service_type = ServiceType::findOrFail($id); 

        try {
            Log::info('Xóa 1 kiểu dịch vụ thành công!');
            $service_type->delete();
            return redirect()->route('admin.service_types.index')-> with('success', 'Xóa 1 kiểu dịch vụ thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.service_types.index')-> with('error', 'Xóa 1 kiểu dịch vụ thất bại!');
        }
    }
}
