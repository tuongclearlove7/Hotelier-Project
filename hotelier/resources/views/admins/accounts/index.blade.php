@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Admin Hotelier')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý tài khoản</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách tài khoản</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách tài khoản</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(!empty($accounts))
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-visible="true">ID</th>
                                    <th data-visible="true">Tên vai trò</th>
                                    <th data-visible="true">Tên người dùng</th>
                                    <th data-visible="true">Tên đăng nhập</th>
                                    <th data-visible="true">Mã vai trò</th>
                                    <th data-visible="true">Mã người dùng</th>
                                    <th data-visible="true"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accounts as $account)
                                    <tr>
                                        <td>{{ $account->id }}</td>
                                        <td>
                                            @if ($account->role)
                                                {{ $account->role->name }}
                                            @endif
                                        </td>
                                        <td>{{ $account->admin->name }}</td>
                                        <td>{{ $account->admin->email }}</td>
                                        <td>{{ $account->role_id }}</td>
                                        <td>{{ $account->admin_id }}</td>
                                        
                                        <td class="project-actions text-right">
                                      
                                        
                                            <form action="{{ route('admin.accounts.update', ['id'=> $account->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <select class="form-control" id="role_id" name="role_id">
                                                        <option value="{{ old('role_id', $account->role_id) }}">
                                                            @if ($account->role)
                                                                {{ old('role_id', $account->role->name) }}
                                                            @endif
                                                        </option>
                                                
                                                        @foreach($roles as $role)
                                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm" ><i class="fas fa-edit"></i> Chỉnh sửa quyền</button>
                                            </form>

            
                                            <form action="{{ route('admin.accounts.destroy', ['id' => $account->id]) }}" method="post" class="btn btn-sm">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="admin_id" value="{{$account->admin_id}}">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete ?')"><i class="fas fa-trash"></i> Xóa</button>
                                            </form>
                                        </td>
                                    </tr>                                
                                @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>account</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection