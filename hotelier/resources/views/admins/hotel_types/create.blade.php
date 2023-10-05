@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Admin Hotelier')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý kiểu khách sạn</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Thêm mới kiểu khách sạn</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm mới kiểu khách sạn</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.hotel_types.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Tên kiểu khách sạn</label>
                <input type="text" name='name' class="form-control" id="exampleInputEmail1" placeholder="Nhập tên kiểu khách sạn">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Số sao kiểu khách sạn</label>
                <select class="form-control" id="star" name="star">
                        @for ($i=1; $i < 6; $i++)
                            <option value="{{ $i }}">{{ $i }} sao</option>
                        @endfor 
                </select>
                @error('star')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
      </div>

     
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.hotel_types.index') }}" class="btn btn-secondary" >Danh sách kiểu khách sạn</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection