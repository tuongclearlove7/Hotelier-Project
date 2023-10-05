<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    public function index()
    {
        $data = [];
        $promotions = Promotion::get();
        $data["promotions"] = $promotions;
        return view('admins.promotions.index', $data);
    }


    public function create()
    {
        $data = [];
        return view('admins.promotions.create',$data);
    }
    public function store(Request $request)
    {
        $dataSave = [
            'code' => $request->code,
            'reduciton' => $request->reduciton,
        ];

        try {
            Log::info('Tạo 1 khuyến mãi thành công!');
            Promotion::create($dataSave);
            return redirect()->route('admin.promotions.index')-> with('success', 'Tạo 1 khuyến mãi thành công');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.promotions.index')-> with('error', 'Tạo 1 khuyến mãi thất bại');
        }
    }

  
    public function show(string $id)
    {

    }

 
    public function edit(string $id)
    {
        $data=[];
        $promotion = Promotion::findOrFail($id);
        $data['promotion'] = $promotion;
        return view('admins.promotions.edit', $data);
    }

  
    public function update(Request $request, string $id)
    {
        $promotion = Promotion::findOrFail($id);

        $dataUpdate = [
            'code' => $request->code,
            'reduciton' => $request->reduciton,
        ];

        try {
             Log::info('Cập nhật 1 khuyến mãi thành công!');
             $promotion->update($dataUpdate);
             return redirect()->route('admin.promotions.index')-> with('success', 'Cập nhật 1 khuyến mãi thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.promotions.index')-> with('error', 'Cập nhật 1 khuyến mãi thất bại!');
        }
    }

   
    public function destroy(string $id)
    {
        $promotion = Promotion::findOrFail($id); 

        try {
            Log::info('Xóa 1 khuyến mãi thành công!');
            $promotion->delete();
            return redirect()->route('admin.promotions.index')-> with('success', 'Xóa 1 khuyến mãi thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.promotions.index')-> with('error', 'Xóa 1 khuyến mãi thất bại!');
        }
    }
}
