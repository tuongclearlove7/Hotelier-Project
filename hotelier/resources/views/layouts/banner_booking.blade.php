    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(customer/img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Đặt phòng</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang Chủ</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Đặt phòng</li>
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

                        <form >
                                <div>
                                   <div class="row g-2">

                                   
                                                     
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="key_receipt" id="key_receipt"  value="" placeholder="Nhập vào tên khách sạn">
                                                <label for="Phone">Nhập vào mã hóa đơn đặt phòng</label>
                                            </div>
                                            <br>
                                            @if(Session::has('error'))
                                            <div class="alert alert-warning alert-dismissible fade show" id='alert_error' role="alert">
                                                <strong>{{ Session::get('error') }}</strong>
                                                <button type="button" class="close" id="close_alert_error" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <br>
                                <div style="max-width:600px;margin:0 auto;">
                                    <a id="submit_search_receipt" class="btn btn-primary w-100">Tìm kiếm</a>
                                </div>
                        </form>
                        


                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->

        <script>

        document.querySelector('#submit_search_receipt').addEventListener('click', function(){

        let key_receipt = document.querySelector('#key_receipt').value;
        console.log(key_receipt);

        return window.location.href = `<?php echo route('booking_details.index'); ?>/${key_receipt}`;
        });

        </script>