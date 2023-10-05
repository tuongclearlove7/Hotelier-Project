@extends('layouts.master')


@section('title','Xem phòng')

@section('content')

@include('layouts.banner_room')
 <!-- Booking Start -->

 <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">PHÒNG CỦA CHÚNG TÔI</h6>
                    <h1 class="mb-5">CHỌN <span class="text-primary text-uppercase">PHÒNG</span></h1>
                </div>
                <div class="row g-5">

                    <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="room-item shadow rounded overflow-hidden">
                            
                                @foreach($rooms as $room)
                                    <br>
                                        <h3 class="mb-0 text-type-room">
                                            <a href="{{route('hotels.index')}}/hotel_detail/{{$room->room_type->hotel->id}}">
                                                <i class="fa fa-hotel text-primary me-2"></i>{{"Khách sạn ".$room->room_type->hotel->name}}
                                            </a>
                                        </h3>
                                    <br>
                                    <div class="py-2 py-img">
                                        <img class="mb-0 text-type-room" src="{{asset('customer/img/'. $room->room_type->image)}}" alt="" width="400px" srcset="">
                                    </div>
                                   
                                    <div class="hotels">
                                        @if ($rooms->isEmpty())
                                            <h4> Không có phòng nào</h4>
                                        @else
                                    </div>
                                
                                    <div class="p-4 mt-2">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div>
                                                <h4 class="text-default">
                                                    <i class="fa fa-home text-primary me-2"></i>
                                                    Phòng {{$room->name}}
                                                </h4>
                                            </div>
                                            <div class="ps-2 ps-type">
                                            <?php
                                                if($room['price'] >= 5000000){
                                                    echo "<b>PHÒNG VIP </b> ";
                                                    for($i = 0; $i < 5; $i++) {
                                                        echo '<small class="fa fa-star text-primary"></small>';
                                                    }
                                                }
                                                if($room['price'] < 5000000){
                                                    echo "<b>PHÒNG THƯỜNG </b> ";
                                                    for($i = 0; $i < 4; $i++) {
                                                        echo '<small class="fa fa-star text-primary"></small>';
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    
                                   
                                    
                                    <div class="d-flex mb-3">
                                        <b>Phòng số {{$room->id}}</b>
                                    </div>
                        
                                    <div class="d-flex mb-3">
                                        <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>{{$room->num_bed}} Giường</small>
                                        <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>{{$room->num_bath_room}} Phòng tắm</small>
                                        <small class="border-end me-3 pe-3"><i class="fa fa-users text-primary me-2"></i>Số khách tối đa {{$room->capactity}} / phòng</small>
                                        <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <small class="border-end me-3 pe-3"><i class="fa fa-home text-primary me-2"></i>Diện tích phòng {{$room->area." m2"}}</small>
                                        <small class="border-end me-3 pe-3">
                                            <?php if($room->status==1) echo '<i class="fa fa-circle text-success me-2"></i> Phòng trống';
                                                  if($room->status==0) echo '<i class="fa fa-circle text-danger me-2"></i> Hết phòng';
                                                  ?>
                                        </small>
                                       
                                    </div>
                                    <div class="d-flex mb-3">
                                        <small class="border-end me-3 pe-3"><i class="fa fa-map text-primary me-2"></i>{{"Địa chỉ ".$room->room_type->hotel->address}}</small>
                                        <small class="border-end me-3 pe-3"><i class="fa fa-city text-primary me-2"></i>{{"Thành phố ". $room->room_type->city->name}}</small>
                                    </div>
                                   
                                    <p class="text-body mb-3"><b>Khung nhìn : </b>{{$room->view}}</p>
                                    <?php 
                                        $giamgia = 0;
                                        $show_ = "";
                                        $gia_goc = "";
                                        $formattedMoney="";
                                       
                                        if($room->price < 450000 && $room->price >= 300000){
                                            $giamgia = $room->price - ($room->price * $giam_gia_thap);
                                            $formattedMoney = number_format($giamgia, 0, ",", ".") . " VNĐ";
                                            $formattedMoneyold = number_format( $room->price, 0, ",", ".") . " VNĐ";
                                            $show_ = "💥 Hiện đang giảm giá ". 100 * $giam_gia_thap . "% 🥳";
                                            $gia_goc = "<b>Giá gốc : </b><del class='text-danger'>".$formattedMoneyold." </del>";
                                        }
                                        else if($room->price >= 450000){
                                            $giamgia = $room->price - ($room->price * $giam_gia_cao);
                                            $formattedMoney = number_format($giamgia, 0, ",", ".") . " VNĐ";
                                            $formattedMoneyold = number_format( $room->price, 0, ",", ".") . " VNĐ";
                                            $gia_goc = "<b>Giá gốc : </b><del class='text-danger'>". $formattedMoneyold. " </del>";
                                        }else{
                                            $giamgia = $room->price;
                                            $formattedMoney = number_format($giamgia, 0, ",", ".") . " VNĐ";
                                        }
                                        
                                            ?>
                                    <div class="d-flex mb-3">
                                        <small class="border-end me-3 pe-3"><b>Mô tả : </b>{{$room->description}}</small>
                                        <small class="border-end me-3 pe-3">{{$show_}}</small>
                                    </div>
                                    <div>
                                        <b><?php echo $gia_goc?></b>
                                        <h4><b>Giá : </b>{{$formattedMoney. " / Đêm"}}</h4>
                                    </div>
                                    <br>
                                    <div  class="d-flex mb-3">
                                    <div class="room_detail">
                                        <a href="{{route('our_rooms.index')}}/room_detail/{{$room->id}}" id="choose-room" class="btn btn-sm btn-success ">
                                            XEM CHI TIẾT PHÒNG SỐ {{$room->id}}
                                        </a>
                                    </div>
                                    
                                    <form style="margin-right: 20px;" action="{{ route('booking_details.store') }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="name" value="{{$room->name}}">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="price" value="{{$giamgia}}">
                                            <input type="hidden" name="status" value="{{$room->status}}">
                                            <input type="hidden" name="area" value="{{$room->area}}">
                                            <input type="hidden" name="address" value="{{$room->room_type->hotel->address}}">
                                            <input type="hidden" name="name_hotel" value="{{$room->room_type->hotel->name}}">
                                            <input type="hidden" name="name_city" value="{{ $room->room_type->hotel->city->name }}">
                                            <input type="hidden" name="num_bed" value="{{$room->num_bed}}">
                                            <input type="hidden" name="num_bath_room" value="{{$room->num_bath_room}}">
                                            <input type="hidden" name="capacity" value="{{$room->capactity}}">
                                            <input type="hidden" name="room_id" value="{{$room->id}}">
                                            <button type="submit" id="choose-room" class="btn btn-sm btn-success ">
                                                    CHỌN PHÒNG
                                            </button>
                                        </form>
                                    
                                    <form action="{{ route('booking_details.index') }}" method="GET">
                                        <button type="submit" class="btn btn-sm btn-success" >CHI TIẾT ĐẶT PHÒNG <i class="fa fa-arrow-right"></i></button>
                                    </form>
                                    </div>
                                    <div class="d-flex justify-content-between">
                            
                                    </div>
                                </div>
                                        
                                    @endif
                                @endforeach
                               
                            </div>
                        </div>
                
                    
                    {{$rooms->appends(request()->input())->links()}}


                </div>
            </div>
        </div>
        <!-- Booking End -->


@endsection
