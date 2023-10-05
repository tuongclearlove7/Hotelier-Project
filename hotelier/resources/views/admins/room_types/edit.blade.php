@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Admin Hotelier')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý kiểu phòng</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa kiểu phòng</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa kiểu phòng</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.room_types.update', ['id'=> $room_type->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
        <div class="form-group">
                <label for="name">kiểu phòng</label>
                <input type="text" value="{{ old('name', $room_type->name) }}"
                 name='name' class="form-control" id="name" placeholder="Nhập tên kiểu phòng">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="image">Ảnh</label>
                <input type="text"  value="{{ old('image', $room_type->image) }}"
                 name='image' class="form-control" id="image" placeholder="Nhập ảnh">
                @error('image')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

         
          
            <div class="form-group">
                <label for="hotel_id">Khách sạn</label>
                <select class="form-control" id="hotel_id" name="hotel_id">
                <option value="{{ $room_type->hotel_id }}">{{ $room_type->hotel->name }}</option>
                    @foreach ($hotels as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach 
                </select>
                @error('hotel_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="city_id">Thành phố</label>
                <select class="form-control" id="city_id" name="city_id">
                <option value="{{ $room_type->city_id }}">{{ $room_type->city->name }}</option>
                    @foreach ($cities as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach 
                </select>
                @error('city_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.room_types.index') }}" class="btn btn-secondary" >Danh sách kiểu phòng</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection