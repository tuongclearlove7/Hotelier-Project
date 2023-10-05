
<form action="{{ route('our_rooms.store') }}" method="POST">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" name="fullname" id="fullname" value="" placeholder="Nhập Họ tên của bạn">
                <label for="name">Nhập Họ tên của bạn</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="email"  value="" placeholder="Nhập Email của bạn">
                <label for="email">Nhập Email của bạn</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" name="phone" id="phone"  value="" placeholder="Nhập Số điện thoại của bạn">
                <label for="Phone">Nhập Số điện thoại của bạn</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" name="address" id="address"  value="" placeholder="Nhập Địa chỉ của bạn">
                <label for="Address">Nhập địa chỉ của bạn</label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-floating date" id="date3" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" name="checkin"  value="" id="checkin" placeholder="Ngày giờ nhận phòng" data-target="#date3" data-toggle="datetimepicker" />
                <label for="checkin">Ngày giờ nhận phòng</label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" name="promotion_id" id="promotion_id"  value="" placeholder="Nhập Mã giảm giá của bạn">
                <label for="Promotion">Nhập Mã giảm giá của bạn</label>
            </div>
        </div>

        <div class="col-md-6" >
            <div class="form-floating date" id="date3" data-target-input="nearest">
                <select class="form-control" name="checkout" id="checkout">
                    <option value="">Chọn số ngày ở </option>
                    <?php 
                        for($i = 1; $i<32; $i++){
                    ?>
                    <option value="<?php echo$i ?>"><?php echo$i. " Ngày" ?></option>
                    <?php }?>
                </select>
                <label for="checkout">Số ngày thuê</label>
            </div>
        </div>

        <div class="col-md-6" >
            <div class="form-floating date" id="date3" data-target-input="nearest">
                <select class="form-control" name="num_guest" id="num_guest">
                    <option value="">Chọn số người / tối đa 7 người / Phòng (Bao gồm cả trẻ em)</option>
                    <?php 
                        for($i = 1; $i<7+1; $i++){
                    ?>
                    <option value="<?php echo$i ?>"><?php echo$i.' Người'?></option>
                    <?php }?>
                </select>
                <label for="num_guest">Số người ở</label>
            </div>
        </div>
        
        <div class="col-12">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Nhập ghi chú" name="node"  value="" id="node" style="height: 100px"/>
                <label for="node">Nhập ghi chú</label>
            </div>
        </div>
    
        <div class="col-12">
            <button class="btn btn-primary w-100 py-3" type="submit">Đặt phòng ngay</button>
        </div>
    </div>
</form>