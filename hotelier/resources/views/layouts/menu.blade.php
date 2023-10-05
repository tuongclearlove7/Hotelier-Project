<nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('home') }}" class="nav-item nav-link active">Trang chủ</a>
                        <a id="about_room" class="nav-item nav-link">Phòng</a>
                        <a id="about_service" class="nav-item nav-link">Dịch vụ</a>
                        <a href="{{route('contacts.index')}}" class="nav-item nav-link">Liên hệ</a>
                        <a href="{{route('bookings.index')}}" class="nav-item nav-link">Đặt phòng</a>
                        <a href="{{route('hotels.index')}}" class="nav-item nav-link">XEM KHÁCH SẠN</a>
                        <a href="{{route('our_rooms.index')}}" class="nav-item nav-link">Xem phòng</a>
                        <a href="{{route('booking_details.index')}}" class="nav-item nav-link">Chi tiết đặt phòng</a>

                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="" class="dropdown-item">Our Team</a>
                                <a href="" class="dropdown-item">Testimonial</a>
                            </div>
                        </div> -->
                </div>
            <!-- <a href="https://htmlcodex.com/hotel-html-template-pro" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">Premium Version<i class="fa fa-arrow-right ms-3"></i></a> -->
    </div>
</nav>
