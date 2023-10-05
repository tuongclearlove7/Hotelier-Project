@extends('layouts.master')


@section('title','Đặt phòng')

@section('content')

@include('layouts.banner_booking')

@if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <p class="text-danger">{{ Session::get('error') }}</p>
    </div>
@endif

 <!-- Booking Start -->
 <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Đặt phòng của chúng tôi</h6>
            <h1 class="mb-5">NHẬP THÔNG TIN ĐỂ <span class="text-primary text-uppercase">ĐẶT PHÒNG</span></h1>
        </div>
        <div class="row g-5">
            <div class="customer-info">
                
                @include('booking_form')   
        
            </div>
        </div>
    </div>
</div>
        <!-- Booking End -->


@endsection
