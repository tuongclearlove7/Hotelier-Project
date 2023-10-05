@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Admin Hotelier')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Quản lý chi tiết đặt phòng</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa chi tiết đặt phòng</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa chi tiết đặt phòng</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.booking_details.update', ['id'=> $booking_detail->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <select class="form-control" id="room_id" name="room_id">
                   
                        <option value="{{ old('room_id', $booking_detail->room_id) }}">
                            @if($booking_detail->room->status == 0)
                                {{ old('room_id', 
                                    "Phòng ".$booking_detail->room->name
                                    ." Đã hết "
                                    ." tại khách sạn "
                                    .$booking_detail->room->room_type->hotel->name) 
                                }}
                            @else
                                {{ old('room_id', 
                                    "Phòng ".$booking_detail->room->name
                                    ." còn trống "
                                    ." tại khách sạn "
                                    .$booking_detail->room->room_type->hotel->name) 
                                }}
                            @endif
                        </option>
                        @foreach($rooms as $room)
                            <option value="{{$room->id}}">
                                @if($room->status == 0)
                                    {{"Phòng ".$room->name. " đã hết tại khách sạn " .$room->room_type->hotel->name }}
                                @else
                                     {{"Phòng ".$room->name. " còn trống tại khách sạn " .$room->room_type->hotel->name }}
                                @endif
                            </option>
                        @endforeach
                </select>
                @error('room_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>


      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('admin.booking_details.index') }}" class="btn btn-secondary" >Danh sách chi tiết đặt phòng</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
<!-- /.card -->
@endsection