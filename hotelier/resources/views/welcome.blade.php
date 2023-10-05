@extends('layouts.master')


@section('title','Trang chủ')

@section('content')

@include('layouts.banner_home')

 <!-- Booking Start -->
 <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">

        <div class="bg-white shadow" style="padding: 35px;">
            <div class="row g-2">
                @include('booking_form')
            </div>
        </div>

    </div>
</div>
<!-- Booking End -->

<!-- About Start -->
<div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
                    <h1 class="mb-4">{{$welcome}} <span class="text-primary text-uppercase">Hotelier</span></h1>
                    <p class="mb-4"> {{$description}}</p>
                    <div class="row g-3 pb-4">
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">
                                       {{$number_hotel}}
                                    </h2>
                                    <p class="mb-0">KHÁCH SẠN</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">{{$staffs}}</h2>
                                    <p class="mb-0">NHÂN VIÊN</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">{{$customers}}</h2>
                                    <p class="mb-0">KHÁCH HÀNG</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="{{ asset('customer/img/about-1.jpg') }}" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="{{ asset('customer/img/about-2.jpg') }}">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="{{ asset('customer/img/about-3.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="{{ asset('customer/img/about-4.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- hotels -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">KHÁCH SẠN CỦA CHÚNG TÔI</h6>
                    <h1 class="mb-5">KHÁM PHÁ <span class="text-primary text-uppercase">KHÁCH SẠN</span></h1>
                </div>
                <div class="row g-4">
                @foreach($hotel_types as $hotel_type)
                    @foreach ($hotel_type->hotels as $hotel)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="{{asset('hotels/hotel_detail/' .$hotel->id)}}">
                            <div class="rounded shadow overflow-hidden">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{asset('customer/img/' .$hotel->image)}}" alt="">
                                </div>
                                <div class="text-center p-3 mt-3">
                                    <h5 class="fw-bold mb-0">Khách sạn {{$hotel_type->name}}</h5>
                                    <br>
                                    <p>Khách sạn {{$hotel->name}}</p>
                                    <small>{{$hotel->description}}</small>

                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
                

    <!-- end hotels -->


    <!-- Room Start -->
    <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 id="pos_room" class="section-title text-center text-primary text-uppercase">Phòng của chúng tôi</h6>
                    <h1  class="mb-5">KHÁM PHÁ <span class="text-primary text-uppercase">Phòng</span></h1>
                </div>
                <div class="row g-4">


                 <!-- Testimonial Start -->
                <div id="list_room" class="container-xxl testimonial my-5 py-5 bg-dark wow zoomIn" data-wow-delay="0.1s">
                    <div class="container">
                        <div class="owl-carousel testimonial-carousel py-5">
                            @foreach($rooms as $room)
                            
                                <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                                    <p></p>
                                    <div class="d-flex align-items-center">
                                        <img class="img-fluid flex-shrink-0 rounded" src="{{asset('customer/img/'. $room->room_type->image)}}" style="width:  70%; height: 100%;">
                                        <div class="ps-3">
                                            <h6 class="fw-bold mb-1 text-default">Phòng số {{$room->id}}</h6>
                                            <h6 class="fw-bold mb-1 text-danger">{{$room->name}}</h6>
                                            <h6>
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
                                            </h6>
                                            <del><?php echo $gia_goc ?></del>
                                            <h6 class="fw-bold mb-1 text-primary">{{$formattedMoney}}</h6>
                                            <small >
                                            <?php if($room->status==1) echo '<i class="fa fa-circle text-success me-2"></i> Phòng trống';
                                                  if($room->status==0) echo '<i class="fa fa-circle text-danger me-2"></i> Hết phòng';
                                                  ?>
                                            </small>
                                            <br>
                                            <small>{{$show_}}</small>
                                            <br>
                                            <small><b>Khách sạn : </b> {{$room->room_type->hotel->name}}</small>
                                            <br>
                                            <small><b>Địa chỉ : </b> {{$room->room_type->hotel->address}}</small>
                                        </div>
                                    </div>
                                    <br>
                                    <div style="display: flex;">
                                        <a href="{{route('our_rooms.index')}}/room_detail/{{$room->id}}" id="choose-room" class="btn btn-sm btn-success ">
                                                XEM CHI TIẾT PHÒNG SỐ {{$room->id}}
                                        </a>

                                        <form style="margin-left: 20px;" action="{{ route('booking_details.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="name" value="{{$room->name}}">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="price" value="{{$giamgia}}">
                                            <input type="hidden" name="status" value="{{$room->status}}">
                                            <input type="hidden" name="area" value="{{$room->room_type->area}}">
                                            <input type="hidden" name="address" value="{{$room->room_type->hotel->address}}">
                                            <input type="hidden" name="name_hotel" value="{{ $room->room_type->hotel->name}}">
                                            <input type="hidden" name="name_city" value="{{ $room->room_type->city->name }}">
                                            <input type="hidden" name="num_bed" value="{{$room->room_type->num_bed}}">
                                            <input type="hidden" name="num_bath_room" value="{{$room->room_type->num_bath_room}}">
                                            <input type="hidden" name="capacity" value="{{$room->room_type->capactity}}">
                                            <input type="hidden" name="room_id" value="{{$room->id}}">
                                            <button type="submit" id="choose-room" class="btn btn-sm btn-success ">
                                                    CHỌN PHÒNG
                                            </button>
                                    </form>
                                    </div>
                                    
                                </div>
                           
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Testimonial End -->

                @foreach($room_types as $room_type)
                        
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{asset('customer/img/' .$room_type->image) }}" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">
                                            1 ĐÊM
                                </small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">

                                          Phòng  {{ $room_type->name }}
                                            
                                    </h5>
                                    <div class="ps-2">
                                        <?php
                                            for($i = 0; $i < 5; $i++) {
                                                echo '<small class="fa fa-star text-primary"></small>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-hotel text-primary me-2"></i>
                                       Khách sạn  {{$room_type->hotel->name}}
                                    </small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-city text-primary me-2"></i>
                                         {{$room_type->hotel->city->name}}
                                    </small>
                                </div>
                               
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{ route('our_rooms.show', $room_type->id) }}">XEM CHI TIẾT</a>
                                    <a class="btn btn-sm btn-dark rounded py-2 px-4" href="{{ route('bookings.index') }}">ĐẶT PHÒNG</a>
                                </div>
                            </div>
                        </div>
                    </div>
                
                @endforeach
                {{$room_types->appends(request()->input())->links()}}

                </div>
            </div>
        </div>
        <!-- Room End -->


        <!-- Video Start -->
        <div class="container-xxl py-5 px-0 wow zoomIn" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-6 bg-dark d-flex align-items-center">
                    <div class="p-5">
                        <h6 class="section-title text-start text-white text-uppercase mb-3">CUỘC SỐNG CAO CẤP</h6>
                        <h1 class="text-white mb-4">KHÁM PHÁ KHÁCH SẠN SANG TRỌNG CÓ THƯƠNG HIỆU</h1>
                        <p class="text-white mb-4">{{$description}}</p>
                        <a href="{{route('our_rooms.index')}}" class="btn btn-primary py-md-3 px-md-5 me-3">PHÒNG CỦA CHÚNG TÔI</a>
                        <a href="{{route('bookings.index')}}" class="btn btn-light py-md-3 px-md-5">ĐẶT PHÒNG</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="video">
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Start -->


         <!-- Service Start -->
         <div class="container-xxl py-5">
            <div class="container">


                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 id="pos_service" class="section-title text-center text-primary text-uppercase">DỊCH VỤ CỦA CHÚNG TÔI</h6>
                    <h1  class="mb-5">KHÁM PHÁ <span class="text-primary text-uppercase">DỊCH VỤ</span></h1>
                </div>
                <div class="row g-4">

                @foreach($service_types as $service_type)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-hotel fa-2x text-primary"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">
                                

                                        {{$service_type->name}}
                        
                        
                            </h5>
                            <p class="text-body mb-0">
                                
                            
                                        {{$service_type->description}}
                                    
                            </p>
                        </a>
                    </div>
                @endforeach
                {{$service_types->appends(request()->input())->links()}}

                </div>
            </div>
        </div>
        <!-- Service End -->


       

@endsection
