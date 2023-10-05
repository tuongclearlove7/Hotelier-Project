<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\Role_user;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class check_role_user
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $roles = Role::pluck('id', 'name'); 

        $admin_role = Role::where('roles.name', 'admin')->get()[0]->id;
        $staff_role = Role::where('roles.name', 'staff')->get()[0]->id;
        $user_email = auth()->guard('admin')->user()->email;

        $role_users = Role_user::select(
        'admins.*', 'roles.*', 'role_users.*'
        ,"roles.name as role_name", 'admins.name as admin_name')
        ->join('admins', 'admins.id', '=', 'role_users.admin_id')
        ->join('roles', 'roles.id', '=', 'role_users.role_id')
        ->where('admins.email', $user_email)
        ->get();

        foreach ($role_users as $role_user){
             if($role_user->role_id == $admin_role){
                return $next($request);
             }
        }
        return redirect()->route('admin.dashboard')->with('error', 'Không đủ quyền!!!');
        
    }
}
