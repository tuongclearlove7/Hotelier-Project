@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Admin Hotelier')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý phòng</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Thêm mới phòng</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm mới phòng</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="name">Tên phòng</label>
                <input type="text" name='name' class="form-control" id="name" placeholder="Nhập tên phòng">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

           
            <div class="form-group">
                <label for="status">Trạng thái phòng</label>
                <select class="form-control" id="status" name="status">
                    @for($i= 0 ; $i <= 1; $i++)
                        @if($i==1)
                            <option value="{{ $i }}">Trạng thái phòng trống</option>
                        @else
                            <option value="{{ $i }}">Trạng thái hết phòng</option>
                        @endif
                    @endfor 
                </select>
                @error('status')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Giá phòng</label>
                <select class="form-control" id="price" name="price">
                    @for($i = 200000; $i < 10000000; $i+=5000)
                        <option value="{{ $i }}">{{ $i. " VNĐ" }}</option>
                    @endfor 
                </select>
                @error('price')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Mô tả phòng</label>
                <input type="text" name='description' class="form-control" id="description" placeholder="Nhập Mô tả phòng">
                @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">Số lượng phòng</label>
                <select class="form-control" id="quantity" name="quantity">
                        @for($i = 1; $i <= 100; $i++)
                            <option value="{{ $i }}">{{ $i. " Phòng" }}</option>
                        @endfor 
                </select>
                @error('quantity')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="num_bed">Số giường</label>
                <select class="form-control" id="num_bed" name="num_bed">
                        @for($i= 1 ; $i < 101; $i++)
                            <option value="{{ $i }}">{{ $i }} giường</option>
                        @endfor 
                </select>
                @error('num_bed')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="num_bath_room">Số phòng tắm</label>
                <select class="form-control" id="num_bath_room" name="num_bath_room">
                        @for($i= 1 ; $i < 101; $i++)
                            <option value="{{ $i }}">{{ $i }} phòng tắm</option>
                        @endfor 
                </select>
                @error('num_bath_room')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>


          

            <div class="form-group">
                <label for="capactity">Sức chứa</label>
                <select class="form-control" id="capactity" name="capactity">
                        @for($i= 1 ; $i < 101; $i++)
                            <option value="{{ $i }}">{{ $i }} người</option>
                        @endfor 
                </select>
                @error('capactity')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="area">Diện tích</label>
                <select class="form-control" id="area" name="area">
                        @for($i= 5 ; $i < 61; $i+=5)
                            <option value="{{ $i }}">{{ $i }} mét vuông</option>
                        @endfor 
                </select>
                @error('area')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="view">Khung nhìn</label>
                <input type="text" name='view' class="form-control" id="view" placeholder="Nhập khung nhìn">
                @error('view')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="room_type_id">Loại phòng</label>
                <select class="form-control" id="room_type_id" name="room_type_id">
                    @foreach($room_types as $room_type)
                    <option value="{{ $room_type->id }}">
                        {{ "Phòng " .$room_type->name ." tại khách sạn " .$room_type->hotel->name  }}
                    </option>"
                    @endforeach
                </select>
                @error('room_type_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>


      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary" >Danh sách phòng</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection