<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(customer/img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-6 text-white mb-3 animated slideInDown">KHÁCH SẠN CỦA CHÚNG TÔI</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">TRANG CHỦ</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">KHÁCH SẠN CỦA CHÚNG TÔI</li>
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
                                            <select name="city_id" class="form-control">
                                                <option value="">Chọn Thành phố</option>
                                                @foreach($city_ids as $id => $city_name)
                                                    <option value="{{ $id }}" 
                                                        {{ old('city_id', request()->get('city_id')) 
                                                        == $id ? 'selected' : '' }}>{{ $city_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="keyword" id="keyword"  value="" placeholder="Nhập vào tên khách sạn">
                                                <label for="Phone">Tìm Khách sạn</label>
                                            </div>
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