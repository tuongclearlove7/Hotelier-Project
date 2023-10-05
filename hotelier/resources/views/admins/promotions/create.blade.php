@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'AdminLTE 3 | Dashboard 2')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý khuyến mãi</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Thêm mới khuyến mãi</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm mới khuyến mãi</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.promotions.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">khuyến mãi</label>
                <input type="text" name='code' class="form-control" id="code" placeholder="Nhập tên khuyến mãi">
                @error('code')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phần trăm khuyến mãi</label>
                <select class="form-control" id="reduciton" name="reduciton">
                        @for ($i=1; $i < 101; $i++)
                            <option value="{{ $i/100 }}">{{ $i }} %</option>
                        @endfor 
                </select>
                @error('reduciton')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary" >Danh sách khuyến mãi</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection