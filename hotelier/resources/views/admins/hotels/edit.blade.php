@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Admin Hotelier')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý khách sạn</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa khách sạn</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa khách sạn</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.hotels.update', ['id'=> $hotel->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên khách sạn</label>
                <input type="text" name='name' class="form-control" id="name" value="{{ old('name', $hotel->name) }}"  placeholder="Nhập tên khách sạn">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
           

            <div class="form-group">
                <label for="image">Địa chỉ khách sạn</label>
                <input type="text" name='address' class="form-control" id="address" value="{{ old('address', $hotel->address) }}" placeholder="Nhập địa chỉ khách sạn">
                @error('image')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Mô tả khách sạn</label>
                <input type="text" name='description' class="form-control" id="description" value="{{ old('description', $hotel->description) }}" placeholder="Nhập mô tả khách sạn">
                @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="image">Ảnh khách sạn</label>
                <input type="text" name='image' class="form-control" id="image" value="{{ old('image', $hotel->image) }}" placeholder="Nhập ảnh khách sạn">
                @error('image')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="hotel_type_id">Loại khách sạn</label>
                <select class="form-control" id="hotel_type_id" name="hotel_type_id">
                <option value="{{ old('hotel_type_id', $hotel->hotel_type_id) }}">{{ old('hotel_type_id', $hotel->hotel_type->name) }}</option>
                        @foreach ($hotel_types as $id => $type)
                            <option value="{{ $id }}">{{ $type }}</option>
                        @endforeach 
                </select>
                @error('hotel_type_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="city_id">Thành phố</label>
                <select class="form-control" id="city_id" name="city_id">
                <option value="{{ old('city_id', $hotel->city_id) }}">{{ old('city_id',  $hotel->city->name) }}</option>

                        @foreach ($cities as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach 
                </select>
                @error('hotel_type_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.hotels.index') }}" class="btn btn-secondary" >Danh sách khách sạn</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection