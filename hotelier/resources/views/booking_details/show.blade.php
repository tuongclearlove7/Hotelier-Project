@extends('layouts.master')


@section('title','Chi tiết hóa đơn đặt phòng')

@section('content')

<!-- Booking Start -->
 <div class="container-xxl py-5">
        <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h6 class="section-title text-center text-primary text-uppercase">HÓA ĐƠN ĐẶT PHÒNG</h6>
                        <h1 class="mb-5">CHI TIẾT <span class="text-primary text-uppercase">HÓA ĐƠN</span></h1>
                </div>
                <div class="booking-receipt-container">
                        <h4>
                            Bạn đã thuê {{$count_room_booking}} phòng
                        </h4>
                        <form action="{{ route('cancel_booking_receipt.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                                @foreach ($booking_receipts as $booking_info)
                                   <h4>
                                    @if($pmt_stt == 0)
                                    <?php   ?>

                                        Tổng số tiền bạn phải thanh toán {{number_format( $booking_info->total_money, 0, ",", ".") . " VNĐ"}}
                                    @else
                                         Tổng số tiền bạn đã thanh toán {{number_format( $booking_info->total_money, 0, ",", ".") . " VNĐ"}}
                                    @endif
                                   </h4>
                                    @break;
                                @endforeach
                               <p>{{$str}}</p>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" readonly class="form-control" name="fullname" id="fullname" value="{{$booking_receipt['fullname']}}">
                                        <label for="fullname">Tên của bạn</label>    
                                    </div> 
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" readonly class="form-control" name="address" id="address" value="{{$booking_receipt['address']}}">
                                        <label for="address">Địa chỉ của bạn</label>       
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" readonly class="form-control" name="checkin" id="checkin" value="{{$booking_receipt['checkin']}}">
                                        <label for="address">Thời gian nhận phòng</label>       
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" readonly class="form-control" name="checkout" id="checkout" value="{{$booking_receipt['checkout']}}">
                                        <label for="address">Thời gian trả phòng</label>       
                                    </div>
                                </div>
                                
                                @if($booking_receipt['cancel_time_status'] == 1)
                                   <div class="col-md-12">
                                       <div class="form-floating">
                                           <input type="text" readonly class="form-control" name="cancel_time_status" id="cancel_time_status" value="Đã hủy đơn đặt phòng">
                                           <label for="address">Trạng thái hủy đơn đặt phòng</label>       
                                       </div>
                                   </div>
                                @else
                                   <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" readonly class="form-control" name="cancel_time_status" id="cancel_time_status" value="Chưa hủy đơn đặt phòng">
                                            <label for="address">Trạng thái hủy đơn đặt phòng</label>        
                                        </div>
                                   </div>
                                @endif
                                

                                @foreach ($booking_receipts as $booking_info)
                                <h5>{{$index++}}</h5>
                                <div class="col-md-4">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control" readonly name="hotel_name"  value="{{$booking_info->hotel_name}}" id="checkin" placeholder="Ngày đến phòng" />
                                        <label for="hotel_name">Khách sạn</label>
                                   </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control" readonly name="room_id"  value="Phòng số {{$booking_info->room_id}}" id="checkin" placeholder="Ngày đến phòng" />
                                        <label for="room_id">Phòng thuê</label>
                                   </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control" readonly name="room_id"  value="{{$booking_info->num_bed}}" id="checkin" placeholder="Ngày đến phòng" />
                                        <label for="room_id">Số giường</label>
                                   </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control" readonly name="room_id"  value="{{$booking_info->num_bath_room}}" id="checkin" placeholder="Ngày đến phòng" />
                                        <label for="room_id">Số phòng tắm</label>
                                   </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control" readonly name="room_id"  value="Tại {{$booking_info->hotel_address}}" id="checkin" placeholder="Ngày đến phòng" />
                                        <label for="room_id">Địa chỉ</label>
                                   </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control" readonly name="room_id"  value="{{$booking_info->view}}" id="checkin" placeholder="Ngày đến phòng" />
                                        <label for="view">Khung nhìn</label>
                                   </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control" readonly name="room_id"  value="Tại {{$booking_info->city_name}}" id="checkin" placeholder="Ngày đến phòng" />
                                        <label for="room_id">Thành phố</label>
                                   </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        @if($pmt_stt == 0)
                                            <input type="text" class="form-control" readonly name="room_id"  value="{{$booking_info->description}}" id="checkin"  />
                                        @else
                                            <input type="text" class="form-control" readonly name="room_id"  value="Đã thanh toán" id="checkin"  />
                                        @endif
                                        <label for="room_id">Mô tả</label>
                                                                     
                                    </div>
                                </div>
                                <hr>
                                
                                @endforeach
                                
                                <input type="hidden" class="form-control" name="booking_receipt_id" id="booking_receipt_id" value="{{$booking_receipt['booking_receipt_id']}}">
                                <input type="hidden" class="form-control" name="role_user_key" id="role_user_key" value="{{$booking_receipt['role_user_key']}}">
                                <input type="hidden" class="form-control" name="booking_now" id="booking_now" value="{{$booking_receipt['booking_now']}}">
                                <input type="hidden" class="form-control" name="cancel_time_status" id="cancel_time_status" value="{{$booking_receipt['cancel_time_status']}}">
                            
                                <div class="col-12">
                                        <button type="submit" class="btn btn-danger w-100 py-3" onclick="return confirm('Bạn chắc chắn muốn hủy đơn đặt phòng chứ ?')"><i class="fas fa-times"></i> HỦY ĐƠN ĐẶT PHÒNG</button>
                                </div>
                        </div>
                        </form>
                </div>
       </div>
</div>
<!-- Booking End -->




@endsection
