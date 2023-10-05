@extends('layouts.master')


@section('title','Chi tiết về khách sạn')

@section('content')

     <!-- Booking Start -->
 <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">KHÁCH SẠN CỦA CHÚNG TÔI</h6>
                    <h1 class="mb-5">CHI TIẾT <span class="text-primary text-uppercase">KHÁCH SẠN</span></h1>
                </div>
                <div class="row g-5">

                @foreach ($hotelType->hotels as $hotel)
                    <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="room-item shadow rounded overflow-hidden">
                                <br>
                                <h3 class="mb-0 text-type-room"><a href="">khách sạn {{$hotelType->name}}</a></h3>
                                <br>
                                <img class="mb-0 text-type-room" src="{{asset('customer/img/' .$hotel->image)}}" alt="" width="70%" srcset="">
                                <div class="p-4 mt-2">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="ps-2">
                                        </div>
                                        <div class="ps-2">
                                            <?php
                                                 for($i = 0; $i < $hotelType->star; $i++) {
                                                    echo '<small class="fa fa-star text-primary"></small>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <h4>Khách sạn {{$hotel->name}}</h4>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <small class="border-end me-3 pe-3">
                                            <i class="fa fa-home text-primary me-2"></i>
                                            <b>Số phòng </b>  {{ app('App\Http\Controllers\HotelController')->count_room($hotel->id) }}    
                                        </small>
                                        
                                    </div>
                                    <div>
                                        <p class="text-body mb-3"><b>Địa chỉ : </b> {{$hotel->address}}</p>
                                        <p class="text-body mb-3"><b>Mô tả : </b> {{$hotel->description}}</p>
                                    </div>
                                    
                                    <br>
                                    <div class="d-flex mb-3">
                                        
                                        <a href="{{route('our_rooms.index')}}?hotel_id={{$hotel->id}}" id="choose-room" class="btn btn-sm btn-success ">
                                                XEM PHÒNG CỦA KHÁCH SẠN NÀY
                                        </a>
                                        
                                    </div>
                                    <div class="d-flex justify-content-between">
                                      
                                        
                                        
                                    </div>
                                </div>
                              @endforeach
                            </div>
                        </div>
                
        

                </div>
            </div>
        </div>
        <!-- Booking End -->




@endsection
