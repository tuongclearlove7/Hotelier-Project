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
        <li class="breadcrumb-item active">Thêm mới tài khoản</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm mới tài khoản</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.accounts.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nhập tên người dùng</label>
                <input type="text" name='name' class="form-control" id="name" placeholder="Nhập tên">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Nhập email đăng nhập</label>
                <input type="email" name='email' class="form-control" id="email" placeholder="Nhập email đăng nhập">
                <input type="hidden" name='email_verified_at' class="form-control"
                value="<?php echo (new DateTime())->format('Y-m-d H:i:s') ?>" id="email_verified_at" >
    
                @error('email')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Nhập mật khẩu đăng nhập</label>
                <input type="text" name='password' class="form-control" id="password" placeholder="Nhập mật khẩu đăng nhập">
                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">

                <select class="form-control" id="role_id" name="role_id">
                        <option value="2">staff</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach 
                </select>
            </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary" >Danh sách tài khoản</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection