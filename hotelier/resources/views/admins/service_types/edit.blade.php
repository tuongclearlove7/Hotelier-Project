@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'AdminLTE 3 | Dashboard 2')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý loại dịch vụ</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa loại dịch vụ</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa loại dịch vụ</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.service_types.update', ['id'=> $service_type->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">loại dịch vụ</label>
                <input type="text" name='name' class="form-control" id="name" placeholder="Nhập tên loại dịch vụ" value="{{ old('name', $service_type->name) }}">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Mô tả loại dịch vụ</label>
                <input type="text" name='description' class="form-control" id="description" placeholder="Nhập mô tả loại dịch vụ" value="{{ old('description', $service_type->description) }}">
                @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.service_types.index') }}" class="btn btn-secondary" >Danh sách loại dịch vụ</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection