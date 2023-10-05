<div class="test-mail" style="text-align: center;">

     
        <h3>
        @foreach($data['bookingInfos'] as $bookingInfo)
                <p>Hi {{$bookingInfo->fullname}}</p>
                @break
        @endforeach  
        </h3>
        <p>{{ $data['notifi_message'] }}</p>
        <b>Mã hóa đơn : {{ $data['ma_hoadon'] }}</b><br>
        <b>Liên hệ chi tiết tổng dài : 1900100 </b>
        @foreach($data['bookingInfos'] as $bookingInfo)
                <p>Ngày nhận phòng {{$bookingInfo->checkin}}</p>
                <p>Ngày trả phòng {{$bookingInfo->checkout}}</p>
                <p>Tổng số tiền thanh toán {{$bookingInfo->total_money}}</p>
                @break
                <hr>
        @endforeach  
        <hr>
                
        @foreach($data['bookingInfos'] as $bookingInfo)
                <p>Khách sạn {{$bookingInfo->hotel_name}}</p>
                <p>Tại thành phố {{$bookingInfo->city_name}}</p>
                <p>Phòng số {{$bookingInfo->room_id}}</p>
                <p>Phòng {{$bookingInfo->room_name}}</p>
                <p>Địa chỉ {{$bookingInfo->address}}</p>
                <hr>
        @endforeach  
        
</div>