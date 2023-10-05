@extends('layouts.master')


@section('title','Xem chi tiết về phòng')

@section('content')

     <!-- Booking Start -->
 <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">PHÒNG CỦA CHÚNG TÔI</h6>
                    <h1 class="mb-5">CHI TIẾT <span class="text-primary text-uppercase">PHÒNG</span></h1>
                </div>
                <div class="row g-5">

                    <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="room-item shadow rounded overflow-hidden">
                                <br>
                                <img class="mb-0 text-type-room" src="{{asset('customer/img/' .$room->image_room)}}" alt="" width="70%" srcset="">
                                <div class="p-4 mt-2">
                                    <div class="d-flex justify-content-between mb-3">
                                       
                                    <div class="p-4 mt-2">
                                        <div class="d-flex justify-content-between mb-3">
                                                <div>
                                                <h4>
                                                <i class="fa fa-home text-primary me-2"></i>
                                                Phòng {{$room->room_name}}
                                            </h4>
                                        </div>
                                        <div class="ps-2">
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
                                        <b>Phòng số {{$room->room_id}}</b>
                                    </div>

                                    <div class="d-flex mb-3">
                                        <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>{{$room->num_bed}} Giường</small>
                                        <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>{{$room->num_bath_room}} Phòng tắm</small>
                                        <small class="border-end me-3 pe-3"><i class="fa fa-users text-primary me-2"></i>Số khách tối đa {{$room->capactity}} / phòng</small>
                                        <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <small class="border-end me-3 pe-3">
                                            <?php
                                                echo $status_room;
                                            ?>
                                        </small>
                                        <small  class="border-end me-3 pe-3"><i class="fa fa-home text-primary me-2"></i>{{$room->quantity}} Phòng</small>
                                        <small class="border-end me-3 pe-3"><i class="fa fa-map text-primary me-2"></i>{{"Khách sạn ".$room->hotel_name}}</small>
                                        <small class="border-end me-3 pe-3"><i class="fa fa-city text-primary me-2"></i>{{"Thành phố ". $room->city_name}}</small>
                                    </div>
                                
                                    <?php 
                                        $giamgia = 0;
                                        $show_ = "";
                                        $gia_goc = "";
                                        $_010 = 0.10;
                                        $_015 = 0.15;

                                        if($room->price < 450000 && $room->price >= 300000){
                                            $giamgia = $room->price - ($room->price * $_010);
                                            $formattedMoney = number_format( $giamgia, 0, ",", ".") . " VNĐ";
                                            $formattedMoneyold = number_format( $room->price, 0, ",", ".") . " VNĐ";
                                            $show_ = "💥 Hiện đang giảm giá ". 100 * $_010 . "% 🥳";
                                            $gia_goc = "<b>Giá gốc : </b><del class='text-danger'>". $formattedMoneyold." </del>";
                                        }
                                        else if($room->price >= 450000){
                                            $giamgia = $room->price - ($room->price * $_015);
                                            $formattedMoney = number_format( $giamgia, 0, ",", ".") . " VNĐ";
                                            $formattedMoneyold = number_format( $room->price, 0, ",", ".") . " VNĐ";
                                            $show_ = "💥 Hiện đang giảm giá ". 100 * $_015 . "% 🥳";
                                            $gia_goc = "<b>Giá gốc : </b><del class='text-danger'>". $formattedMoneyold." </del>";
                                        }else{
                                            $giamgia = $room->price;
                                            $formattedMoney = number_format( $giamgia, 0, ",", ".") . " VNĐ";
                                        }
                                        
                                        ?>

                                    <div>
                                        <p class="text-body mb-3"><b>Địa chỉ : </b> {{$room->address}}</p>
                                        <p class="text-body mb-3"><b>Khung nhìn : </b>{{$room->view}}</p>
                                        <p class="text-body mb-3"><b>Mô tả : </b> {{$room->description_room}}</p>
                                        <div class="d-flex mb-3">
                                             <small class="border-end me-3 pe-3"><?php echo $gia_goc ?></small>
                                             <small class="border-end me-3 pe-3"><?php echo $show_ ?></small>

                                        </div>
                                        <h4><b>Giá : </b>{{$formattedMoney. " VNĐ"}}</h4>
                                    </div>
                                    
                                    <br>
                                    <div class="d-flex mb-3">

                                        <div class="room_detail">
                                            <form action="{{ route('our_rooms.index') }}" method="GET">
                                                <button type="submit" class="btn btn-sm btn-success" >
                                                        <i class="fa fa-arrow-left"></i> Quay về xem tất cả các phòng
                                                 </button>
                                            </form>
                                        </div>
                                        
                                        <form style="margin-right: 20px;" action="{{ route('booking_details.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="name" value="{{$room->room_name}}">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="price" value="{{$giamgia}}">
                                                <input type="hidden" name="status" value="{{$room->status}}">
                                                <input type="hidden" name="area" value="{{$room->area}}">
                                                <input type="hidden" name="address" value="{{$room->address}}">
                                                <input type="hidden" name="name_hotel" value="{{ $room->hotel_name}}">
                                                <input type="hidden" name="name_city" value="{{ $room->city_name }}">
                                                <input type="hidden" name="num_bed" value="{{$room->num_bed}}">
                                                <input type="hidden" name="num_bath_room" value="{{$room->num_bath_room}}">
                                                <input type="hidden" name="capacity" value="{{$room->capactity}}">
                                                <input type="hidden" name="room_id" value="{{$room->room_id}}">
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
                            </div>
                        </div>
                
        

                </div>
            </div>
        </div>
        <!-- Booking End -->




@endsection
