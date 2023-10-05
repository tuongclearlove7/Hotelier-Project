@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'AdminLTE 3 | Dashboard 2')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý Thành phố</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa thành phố</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa thành phố</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.cities.update', ['id'=> $city->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Thành phố</label>
                <input type="text" name='name' class="form-control" id="exampleInputEmail1" placeholder="Nhập tên thành phố" value="{{ old('name', $city->name) }}">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary" >Danh sách thành phố</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection