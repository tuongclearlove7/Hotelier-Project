@extends('layouts.master')


@section('title','Xem khách sạn')

@section('content')
@include('layouts.banner_hotel')

 <!-- Booking Start -->
 @foreach($hotels as $hotel)
        <h3>{{--$hotel->hotel_type->name--}}</h3>
 @endforeach


 <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">KHÁCH SẠN CỦA CHÚNG TÔI</h6>
                    <h1 class="mb-5">XEM PHÒNG <span class="text-primary text-uppercase">KHÁCH SẠN</span></h1>
                </div>
                <div class="row g-5">

                    <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="room-item shadow rounded overflow-hidden">
                           @foreach($hotel_types as $hotel_type)
                                @foreach ($hotel_type->hotels as $hotel)
                                  
                                    <br>
                                    <h3 class="mb-0 text-type-room">
                                        <a href="{{route('hotels.index')}}/{{$hotel_type->id}}">
                                            khách sạn {{$hotel_type->name}}
                                            <?php
                                                for($i = 0; $i < $hotel_type->star; $i++) {
                                                    echo '<small class="fa fa-star text-primary"></small>';
                                                }

                                            ?>
                                        </a>
                                    </h3>
                                    <br>
                                    <img class="mb-0 text-type-room" src="{{asset('customer/img/'.$hotel->image)}}" alt="" width="400px" srcset="">
                                    <div class="p-4 mt-2">
                            
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
                                            
                                            <a href="{{route('our_rooms.index')}}?room_type_id=" id="choose-room" class="btn btn-sm btn-success ">
                                                    XEM PHÒNG CỦA KHÁCH SẠN NÀY
                                            </a>
                                            
                                        </div>
                                        <div class="d-flex justify-content-between">
                                        
                                            
                                            
                                        </div>
                                    </div>
                                     
                                  @endforeach
                                @endforeach
                            </div>
                        </div>
                
                    
                    {{-- $room_types->appends(request()->input())->links() --}}


                </div>
            </div>
        </div>
        <!-- Booking End -->


@endsection
