@extends('layouts.master')


@section('title','Chi tiết đặt phòng')

@section('content')

@include('layouts.banner_booking_detail')



<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-default text-uppercase">Đặt phòng</h6>
            <h1 class="mb-5"><span class="text-primary text-uppercase">Phòng của bạn</span></h1>
        </div>
        <div class="row g-5">
        <div class="col-lg-6">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
                <h3 class="total-price">
                <?php 
                $sum = 0;
                if (isset($selectRooms) && is_array($selectRooms)) {
                    foreach ($selectRooms as $room) {
                        if (isset($room["price"]) && isset($room["quantity"])) {
                            $sum += $room["price"] * $user_info['checkout'] * $room["quantity"];
                        } 
                    }
                } 
                if($sum != 0){
                   
                    $giamgia =  $sum*$so_ngay_o;
                    $formattedMoney = number_format( $sum - $giamgia, 0, ",", ".") . " VNĐ";
                    echo $formattedMoney;
                }
                else{
                    
                    echo "<a href='/OurRooms' >Vui lòng chọn phòng !</a>";
                }
        
                ?>
                 
                </h3>
                
                
                <br>
                <div class="col-lg-10 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item shadow rounded overflow-hidden">
                    @if (isset($selectRooms) && is_array($selectRooms))
                        @foreach($selectRooms as $room)
                        
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{'Phòng ' .$room["name"]}}</h5>
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
                                <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>{{$room["num_bed"]}} Bed</small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>{{$room["num_bath_room"]}} Bath</small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-home text-primary me-2"></i>{{$room["area"]}} m2</small>

                                <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <small class="border-end me-3 pe-3"><i class="fa fa-map text-primary me-2"></i>{{"Địa chỉ ". $room["address"]}}</small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-hotel text-primary me-2"></i>Khách sạn {{$room["name_hotel"]}} </small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-city text-primary me-2"></i>Thành phố {{$room["name_city"]}}</small>
                                <br>

                            </div>
                            <h4>Chọn dịch vụ</h4>
                            <form action="{{route('booking_details.store')}}" method="POST">
                            @csrf
                                @foreach($services as $service)
                                        <div class="form-check">
                                            <input onclick="SendID(<?php echo $service->id; ?>);" class="form-check-input service-checkbox"
                                             name="service_id"  type="checkbox" value="{{$service->id}}" id="service_{{$service->id}}" 
                                             data-service-price="{{$service->price}}">
                                            <label class="form-check-label" for="service_{{$service->id}}">
                                                {{$service->name}}
                                            </label>
                                        </div>
                                @endforeach
                            </form>
                            
                            <br>
                            
                            <div class="d-flex justify-content-between">
                                @if(!empty($room['room_id']))
                                    <form action="{{ route('booking_details.remove', $room['room_id']) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-common" onclick="return confirm('Confirm delete ?')"><i class="fas fa-trash-alt"></i> XÓA</button>
                                        
                                    </form>
                                @endif
                                    <form action="{{ route('our_rooms.index') }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-common" ><i class="fa fa-arrow-left"></i> TRỞ VỀ CHỌN PHÒNG</button>
                                    </form>
                            </div>

                            <div class="col-md-3" >
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                
            </div>
                
        </div>
           
        <div class="col-lg-6">
                <div class="text-info">
                    <h2 class="section-title text-default text-uppercase">Thông tin của bạn</h2>
                </div>
                <br>

              

                <fieldset>
                    <legend>VUI LÒNG CHỌN PHƯƠNG THỨC THANH TOÁN:</legend>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="vnpay_payment">
                        <label class="form-check-label" for="flexSwitchCheckDefault">THANH TOÁN TRỰC TUYẾN VNPAY</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="payment_tamthoi" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">THANH TOÁN TẠM THỜI</label>
                    </div>

                </fieldset>
                
                <div style="margin-top: 5px;">
                    <legend>{{$user_info['num_guest']. " Khách"}}</legend>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" readonly name="promotion" id="promotion" value="<?php 
                        if($reduciton!=0) echo "Mã giảm giá của bạn được giảm ". $reduciton*100 ."%";
                        else echo "Mã giảm giá của bạn được giảm ". $reduciton*100 ."%";
                        ?>" placeholder="Tên của bạn">
                    </div>
                </div>
                <br>
                
                <div class="form-booking-info">
                    <form  id="form_method" action="" method="POST">
                    
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" readonly name="fullname" id="fullname" value="{{ $user_info['fullname'] }}" placeholder="Tên của bạn">
                                <label for="name">Tên của bạn</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" readonly name="email" id="email"  value="{{ $user_info['email'] }}" placeholder="Email của bạn">
                                <label for="email">Email của bạn</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" readonly name="phone" id="phone"  value="{{ $user_info['phone'] }}" placeholder="Số điện thoại của bạn">
                                <label for="Phone">Số điện thoại của bạn</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" readonly name="address" id="address"  value="{{ $user_info['address'] }}" placeholder="Địa chỉ của bạn">
                                <label for="Address">Địa chỉ của bạn</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating date" id="date3" data-target-input="nearest">
                                <input type="text" class="form-control" readonly name="checkin"  value="{{ $user_info['checkin'] }}" id="checkin" placeholder="Ngày đến phòng" />
                                <label for="checkin">Ngày nhận phòng</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating date" id="date3" data-target-input="nearest">
                                <input type="text" class="form-control" readonly name="checkout"  value="<?php 
                                
                                    $checkin = new DateTime($user_info['checkin']);
                                    $checkout = $user_info['checkout'];
                                    $checkin->add(new DateInterval('P' . $checkout . 'D'));
                                    echo $checkin->format('Y-m-d H:i');
                                    
                                ?>" id="checkout" placeholder="Ngày trả phòng" />
                                <label for="checkin">Ngày trả phòng</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="hidden" class="form-control" readonly  name="total_money" id="total_money"  value="<?php echo$sum - ($sum*$so_ngay_o)?>" placeholder="Tổng tiền">
                               
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" readonly id=""  value="{{ $user_info['checkout'] .' Ngày'}}" placeholder="Số ngày ở của bạn">
                                <label for="">Số ngày ở của bạn</label>
                            </div>
                        </div>

                        <div style="display: none;" id="col_bank_id"  class="col-md-12">
                            <div class="form-floating date" id="date3" data-target-input="nearest">
                                <select style="display: none;"  class="form-select" id="bank_id" name="bank_id">
                                        <option selected>Chọn Tên thẻ</option>
                                        @foreach ($banks as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach 
                                </select>
                            </div>
                        </div>

                    <br>

                    <div style="display: none;" id="col_number_card" class="col-md-12">
                        <div class="form-floating">
                            <input style="display: none;" type="text" class="form-control"  name="number_card" id="number_card"  value="" placeholder="Số thẻ">
                            <label style="display: none;" id="lb_number_card" for="number_card">Số Thẻ</label>
                        </div>
                    </div>

                    <br>

                    <div style="display: none;" id="col_expiry_date"  class="col-md-12">
                        <div class="form-floating date" id="date3" data-target-input="nearest">
                            <input style="display: none;" type="text" class="form-control datetimepicker-input" id="expiry_date" name="expiry_date"  value=""  placeholder="Ngày hết hạn" data-target="#date3" data-toggle="datetimepicker" />
                            <label style="display: none;" id="lb_expiry_date" for="expiry_date">Ngày hết hạn</label>
                        </div>
                    </div>  
                    <br>

                
                    <div style="display: none;" id="col_btn_payment_tamthoi"  class="col-12">
                        <button style="display: none;" id="btn_payment_tamthoi" class="btn btn-primary w-100 py-3" type="submit">THANH TOÁN TẠM THỜI</button>
                    </div>

                    <div style="display: none;"  class="col-md-12" id="col_bank_name">
                            <div   class="form-floating date" id="date3" data-target-input="nearest">
                                <select id="bank_name" class="form-select" name="bank_name">
                                    <option selected>Chọn Tên thẻ</option>
                                    @foreach ($banks as $id => $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                       
                        <br>

                        <div style="display: none;" id="col_btn_payment_vnpay"  class="col-12">
                            <button id="btn_payment_vnpay" class="btn btn-primary w-100 py-3" name="redirect" type="submit">THANH TOÁN TRỰC TUYẾN VNPAY</button>
                        </div>
                        <br>   

                        </div>
                        <br>
                    
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<script>

document.querySelector('#submit_search_receipt').addEventListener('click', function(){

    let key_receipt = document.querySelector('#key_receipt').value;
    console.log(key_receipt);

    return window.location.href = `<?php echo route('booking_details.index'); ?>/${key_receipt}`;
});

let vnpay_payment_checkbox = document.getElementById('vnpay_payment');
let payment_tamthoi_checkbox = document.getElementById('payment_tamthoi');
vnpay_payment_checkbox.checked = false;
payment_tamthoi_checkbox.checked = false;

document.addEventListener('DOMContentLoaded', function() {

    vnpay_payment_checkbox.addEventListener('change', function() {

        let show_tag_elements = [
            '#col_bank_name', '#bank_name', 
            '#col_btn_payment_vnpay', '#btn_payment_vnpay'
        ];
            
        let hidden_tag_elements = [
            '#col_bank_id', '#bank_id', '#col_number_card', '#number_card',
            '#lb_number_card','#col_expiry_date', '#expiry_date','#lb_expiry_date',
            '#col_btn_payment_tamthoi','#btn_payment_tamthoi'
        ];


        if (this.checked) {

            payment_tamthoi_checkbox.checked = false;
           
            var form = document.querySelector('#form_method');
            form.action = "{{ route('payments.vnpay_payment') }}";
            console.log(form.action);
           
        
            for(var i = 0; i < show_tag_elements.length; i++){

                document.querySelector(show_tag_elements[i]).style.display = "block";
            }

            for(var i = 0; i < hidden_tag_elements.length; i++){

                document.querySelector(hidden_tag_elements[i]).style.display = "none";
            }
           
        }else{

            for(var i = 0; i < show_tag_elements.length; i++){

                document.querySelector(show_tag_elements[i]).style.display = "none";
            }
        }
    });
});



document.addEventListener('DOMContentLoaded', function() {

    payment_tamthoi_checkbox.addEventListener('change', function() {

        var show_tag_elements = [
            '#col_bank_id', '#bank_id', '#col_number_card', '#number_card',
            '#lb_number_card','#col_expiry_date', '#expiry_date','#lb_expiry_date',
            '#col_btn_payment_tamthoi','#btn_payment_tamthoi'
        ];
        
        var hidden_tag_elements = [
            '#col_bank_name', '#bank_name', 
            '#col_btn_payment_vnpay', '#btn_payment_vnpay'
        ]; 

        if (this.checked) {

            vnpay_payment_checkbox.checked = false;

            var form = document.querySelector('#form_method');
            form.action = "{{ route('payments.store') }}";
            console.log(form.action);

        
            for(var i = 0; i < show_tag_elements.length; i++){

                document.querySelector(show_tag_elements[i]).style.display = "block";
            }

            for(var i = 0; i < hidden_tag_elements.length; i++){

                document.querySelector(hidden_tag_elements[i]).style.display = "none";
            }

        
        }else{
            for(var i = 0; i < show_tag_elements.length; i++){

                document.querySelector(show_tag_elements[i]).style.display = "none";
            }
        }
    });
});



</script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const totalPriceElement = document.querySelector('.total-price');
    const totalMoneyElement = document.querySelector('#total_money');
    const serviceCheckboxes = document.querySelectorAll('.service-checkbox');
    serviceCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let totalPrice = parseFloat(totalPriceElement.innerText);
            let totalMoney = parseFloat(totalMoneyElement.value);

            const servicePrice = parseFloat(this.getAttribute('data-service-price'));

            if (this.checked) {
                totalPrice += servicePrice;
                totalMoney += servicePrice;
               
            } else {
                totalPrice -= servicePrice;
                totalMoney -= servicePrice;

            }

            totalPriceElement.innerText = totalPrice.toFixed(2) + " VNĐ";
            totalMoneyElement.value = totalPrice.toFixed(2);

        });
    });
});  

var list_price = []; 

function SendID(serviceID) {
    var checkbox = document.getElementById("service_" + serviceID);
    if (checkbox.checked) {
        var valueCheck = checkbox.value;
        var service_id = valueCheck;
        console.log(service_id);
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); 
        $.ajax({
            type: "POST",
            url: "{{route('save_session.saveIDToSession')}}",
            data: {
                _token: csrfToken,
                service_id: service_id
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
        
    }else{
        var valueCheck = checkbox.value;
        var service_id = valueCheck;
        console.log(service_id);
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); 
        $.ajax({
            type: "POST",
            url: "{{route('remove_session.removeIDFromSession')}}",
            data: {
                _token: csrfToken,
                service_id: service_id
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    }
    

}

</script>

@endsection
