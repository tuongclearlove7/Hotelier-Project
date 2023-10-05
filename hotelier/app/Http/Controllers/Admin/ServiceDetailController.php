<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceDetailController extends Controller
{
   
    public function index()
    {
        $data = [];
        $service_details = ServiceDetail::with(['booking','service'])->orderBy('id', 'asc')->get();
        $data["service_details"] = $service_details;

        return view('admins.service_details.index', $data);
    }

   
    public function edit(string $id)
    {
        $data=[];
        $service_detail = ServiceDetail::findOrFail($id);
        $services = Service::get();

        $data['services'] = $services;
        $data['service_detail'] = $service_detail;

        return view('admins.service_details.edit', $data);
    }

   
    public function update(Request $request, string $id)
    {
        $service_detail = ServiceDetail::findOrFail($id);

        $dataUpdate = [
            "service_id" => $request->service_id,

        ];

        try {
             Log::info('Cập nhật 1 hóa đơn thành công!');
             $service_detail->update($dataUpdate);
             return redirect()->route('admin.service_details.index')-> with('success', 'Cập nhật 1 hóa đơn thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.service_details.index')-> with('error', 'Cập nhật 1 hóa đơn thất bại!');
        }
    }

    
    public function destroy(string $id)
    {
        $service_detail = ServiceDetail::findOrFail($id); 

        try {
            Log::info('Xóa 1 hóa đơn thành công!');
            $service_detail->delete();
            return redirect()->route('admin.service_details.index')-> with('success', 'Xóa 1 hóa đơn thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.service_details.index')-> with('error', 'Xóa 1 hóa đơn thất bại!');
        }
    }
}
