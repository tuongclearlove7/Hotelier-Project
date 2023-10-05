@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'AdminLTE 3 | Dashboard 2')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý chi tiết dịch vụ/h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa chi tiết dịch vụ/li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa chi tiết dịch vụ cho khách</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.service_details.update', ['id'=> $service_detail->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <select class="form-control" id="service_id" name="service_id">
                   
                        <option value="{{ old('service_id', $service_detail->service_id) }}">
                            {{ old('service_id', $service_detail->service->name) }}
                        </option>
                        @foreach($services as $service)
                            <option value="{{$service->id}}">
                                {{$service->name}}
                            </option>
                        @endforeach
                </select>
                @error('service_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>


      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.service_details.index') }}" class="btn btn-secondary" >Danh sách chi tiết dịch vụ </a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection