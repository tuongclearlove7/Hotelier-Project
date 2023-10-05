<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Role_user;

class AccountController extends Controller
{
  
    public function index()
    {
        $data = [];
        $accounts = Role_user::with(['admin','role'])->orderBy('id', 'asc')->get();
        $roles = Role::get();

        $data["accounts"] = $accounts;
        $data["roles"] = $roles;
        return view('admins.accounts.index', $data);
    }

    
    public function create()
    {
        $data = [];

        $roles = Role::get();

        $data["roles"] = $roles;

        return view('admins.accounts.create',$data);
    }

   
    public function store(Request $request)
    {

        $dataSave = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at'=> $request->email_verified_at,
            'password'=> $request->password,
            'remember_token'=> sha1($request->password),
        ];

        try {
            Log::info('Tạo 1 tài khoản thành công!');
            Admin::create($dataSave);

            $admin_id = Admin::max('id');
            
            $datasave_role_user = [
               'admin_id' => $admin_id,
               'role_id' => $request->root_id,
            ];

            Role_user::create($datasave_role_user);

            return redirect()->route('admin.accounts.index')-> with('success', 'Tạo 1 tài khoản thành công');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.accounts.index')-> with('error', 'Tạo 1 tài khoản thất bại');
        }
    }

   
    public function edit(string $id)
    {
        $data=[];
        $city = Admin::findOrFail($id);
        $data['city'] = $city;
        return view('admins.accounts.edit', $data);
    }

    
    public function update(Request $request, string $id)
    {
        $account = Role_user::findOrFail($id);

        $dataUpdate = [
            'role_id' => $request->role_id,
        ];

        try {
             Log::info('Cập nhật vai trò cho tài khoản thành công!');
             $account->update($dataUpdate);
             return redirect()->route('admin.accounts.index')-> with('success', 'Cập nhật vai trò cho tài khoản thành công!');
        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return redirect()->route('admin.accounts.index')-> with('error', 'Cập nhật vai trò cho tài khoản thất bại!');
        }
    }

  
    public function destroy(Request $request,string $id)
    {

        $user = Role_user::findOrFail($id); 
        $admin = Admin::where('id',$request->admin_id)->first(); 

        try {
            Log::info('Xóa 1 tài khoản thành công!');
            $user->delete();
            $admin->delete();
            return redirect()->route('admin.accounts.index')-> with('success', 'Xóa 1 tài khoản thành công!');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('admin.accounts.index')-> with('error', 'Xóa 1 tài khoản thất bại!');
        }
    }
}
