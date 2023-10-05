<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(customer/img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-6 text-white mb-3 animated slideInDown">PHÒNG CỦA CHÚNG TÔI</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">TRANG CHỦ</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">PHÒNG CỦA CHÚNG TÔI</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Booking Start -->
        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">
                    <div class="row g-2">

                        <form action="" method="get">
                                <div>
                                   <div class="row g-2">

                                      

                                   <div class="col-md-12">
                                             <select name="room_type_id" class="form-select">
                                                <option value="" >Chọn khách sạn</option>
                                                @foreach($hotel_selects as $room)
                                                        <option value="{{ $room->room_type_id }}" 
                                                        {{ old('') == $room->room_type_id ? 'selected' : '' }}>{{ $room->room_type->hotel->name}}
                                                        </option>
                                                @endforeach
                                             </select>
                                        </div>
                                    
                                        <div class="col-md-4">
                                             <select name="area" class="form-select">
                                                <option value="" >Chọn diện tích</option>
                                                @foreach($area_selects as  $room)
                                                        <option value="{{ $room->area }}" 
                                                              {{ old('') 
                                                               == $room->area ? 'selected' : '' }}>{{ $room->area. "m2" }}
                                                        </option>
                                                @endforeach
                                              </select>
                                        </div>

                                        <div class="col-md-4">
                                            <select name="view" class="form-select">
                                                <option value="" >Chọn Khung nhìn</option>
                                                @foreach($view_selects as  $room)
                                                        <option value="{{ $room->view }}" 
                                                              {{ old('') 
                                                               == $room->view ? 'selected' : '' }}>{{ $room->view}}
                                                        </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <select name="status" class="form-select">
                                                <option value="" >Tìm phòng trống</option>
                                                <option value="1">Phòng trống</option>
                                            </select>
                                        </div>

                                     
                                    </div>
                                </div>
                                <br>
                                <div style="max-width:600px;margin:0 auto;">
                                        <button class="btn btn-primary w-100">Tìm kiếm</button>
                                </div>
                        </form>
                        


                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->