@extends('admins.layouts.master')

{{-- set page title --}}
@section('title', 'Trang Admin')

@section('content-header')
<div class="row mb-2">
  <div class="col-sm-6">
      <h1 class="m-0">Trang chủ</h1>
  </div><!-- /.col -->
@endsection


@section('content')
@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" id='alert_error' role="alert">
        <strong>{{ Session::get('error') }}</strong>
        <button type="button" class="close" id="close_alert_error" data-dismiss="alert" aria-label="Close">
            <span style="color : black;" aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$city_count}}</h3>

        <p>Thành phố</p>
      </div>
      <div class="icon">
        <i class="fas fa-city"></i>
      </div>
      <a href="{{route('admin.cities.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$hotel_type_count}}<sup style="font-size: 20px"></sup></h3>

        <p>Loại khách sạn</p>
      </div>
      <div class="icon">
        <i class="fas fa-hotel"></i>
      </div>
      <a href="{{route('admin.hotel_types.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{$hotel_count}}</h3>

        <p>Khách sạn</p>
      </div>
      <div class="icon">
        <i class="fas fa-hotel"></i>
      </div>
      <a href="{{route('admin.hotels.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$room_type_count}}</h3>

        <p>Loại phòng</p>
      </div>
      <div class="icon">
        <i class="fas fa-home"></i>
      </div>
      <a href="{{route('admin.room_types.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$room_count}}</h3>

        <p>Phòng</p>
      </div>
      <div class="icon">
        <i class="fas fa-home"></i>
      </div>
      <a href="{{route('admin.rooms.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{$service_count}}</h3>

        <p>Dịch vụ</p>
      </div>
      <div class="icon">
        <i class="fas fa-hotel"></i>
      </div>
      <a href="{{route('admin.service_types.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$booking_count}}<sup style="font-size: 20px"></sup></h3>

        <p>Booking</p>
      </div>
      <div class="icon">
        <i class="fas fa-hotel"></i>
      </div>
      <a href="{{route('admin.bookings.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$booking_receipt_count}}<sup style="font-size: 20px"></sup></h3>

        <p>Hóa đơn đặt phòng</p>
      </div>
      <div class="icon">
        <i class="fas fa-book"></i>
      </div>
      <a href="{{route('admin.booking_receipts.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$booking_detail_count}}<sup style="font-size: 20px"></sup></h3>

        <p>Chi tiết đặt phòng</p>
      </div>
      <div class="icon">
        <i class="fas fa-hotel"></i>
      </div>
      <a href="{{route('admin.booking_details.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$service_detail_count}}<sup style="font-size: 20px"></sup></h3>

        <p>Chi tiết khách hàng chọn dịch vụ</p>
      </div>
      <div class="icon">
        <i class="fas fa-hotel"></i>
      </div>
      <a href="{{route('admin.service_details.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$bank_count}}<sup style="font-size: 20px"></sup></h3>

        <p>Ngân hàng</p>
      </div>
      <div class="icon">
        <i class="fas fa-hotel"></i>
      </div>
      <a href="{{route('admin.booking_receipts.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$account_count}}<sup style="font-size: 20px"></sup></h3>

        <p>Tài khoản</p>
      </div>
      <div class="icon">
        <i class="fas fa-hotel"></i>
      </div>
      <a href="{{route('admin.accounts.index')}}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>








</div>
<!-- /.row -->
@endsection