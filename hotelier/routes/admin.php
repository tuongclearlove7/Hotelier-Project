
<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\Booking_receiptController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\BookingDetailController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\HotelTypeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\ServiceDetailController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingReceipt;
use App\Models\City;
use App\Models\Hotel;
use App\Models\HotelType;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'check_login_admin'], function () {

    Route::get('/', function () {
        
        
        $data=[];

        $city_count = City::count();
        $hotel_type_count = HotelType::count();
        $hotel_count = Hotel::count();
        $room_type_count = RoomType::count();
        $room_count = Room::count();
        $service_count = Service::count();
        $service_type_count = ServiceType::count();
        $booking_count = Booking::count();
        $booking_receipt_count = BookingReceipt::count();
        $booking_detail_count = BookingDetail::count();
        $service_detail_count = ServiceDetail::count();
        $bank_count = Bank::count();
        $account_count = Admin::join('role_users', 'admins.id', '=', 'role_users.admin_id')
        ->join('roles', 'roles.id', '=', 'role_users.role_id')
        ->count();

        $data['city_count']= $city_count;
        $data['hotel_type_count']= $hotel_type_count;
        $data['hotel_count']= $hotel_count;
        $data['room_type_count']= $room_type_count;
        $data['room_count']= $room_count;
        $data['service_count']= $service_count;
        $data['service_type_count']= $service_type_count;
        $data['booking_count']= $booking_count;
        $data['booking_receipt_count']= $booking_receipt_count;
        $data['booking_detail_count']= $booking_detail_count;
        $data['service_detail_count']= $service_detail_count;
        $data['bank_count']= $bank_count;
        $data['account_count']= $account_count;


    return view('admins.dashboard', $data);

    })->name('dashboard');

    
    Route::get('/login', [LoginController::class, 'showForm'])->name('login')->middleware('check_login_admin');
    
    Route::post('/login', [LoginController::class, 'handleForm'])->name('handle-login')->middleware('check_login_admin');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
  
    Route::get('/cities', [CityController::class, 'index'])-> name('cities.index');
   
    Route::get('/hotel_types', [HotelTypeController::class, 'index'])-> name('hotel_types.index');
   
    Route::get('/promotions', [PromotionController::class, 'index'])-> name('promotions.index');
   
    Route::get('/hotels', [HotelController::class, 'index'])-> name('hotels.index');
  
    Route::get('/room_types', [RoomTypeController::class, 'index'])-> name('room_types.index');

    Route::get('/service_types', [ServiceTypeController::class, 'index'])-> name('service_types.index');

    Route::get('/rooms', [RoomController::class, 'index'])-> name('rooms.index');

    Route::get('/bookings', [BookingController::class, 'index'])-> name('bookings.index');

    Route::get('/booking_receipts', [Booking_receiptController::class, 'index'])-> name('booking_receipts.index');
    Route::put('/booking_details/{id}', [BookingDetailController::class, 'update'])-> name('booking_details.update');
    Route::get('/booking_details/{id}/edit', [BookingDetailController::class, 'edit'])-> name('booking_details.edit');
    Route::delete('/booking_details/{id}', [BookingDetailController::class, 'destroy'])-> name('booking_details.destroy');

    Route::get('/booking_details', [BookingDetailController::class, 'index'])-> name('booking_details.index');
    Route::put('/booking_receipts/{id}', [Booking_receiptController::class, 'update'])-> name('booking_receipts.update');
    Route::get('/booking_receipts/{id}/edit', [Booking_receiptController::class, 'edit'])-> name('booking_receipts.edit');
    Route::delete('/booking_receipts/{id}', [Booking_receiptController::class, 'destroy'])-> name('booking_receipts.destroy');

    Route::get('/service_details', [ServiceDetailController::class, 'index'])-> name('service_details.index');
    Route::put('/service_details/{id}', [ServiceDetailController::class, 'update'])-> name('service_details.update');
    Route::get('/service_details/{id}/edit', [ServiceDetailController::class, 'edit'])-> name('service_details.edit');
    Route::delete('/service_details/{id}', [ServiceDetailController::class, 'destroy'])-> name('service_details.destroy');


    Route::middleware('check_role_user')->group(function () {
        
        Route::post('/cities', [CityController::class, 'store'])-> name('cities.store');
        Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
        Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
        Route::get('/cities/{id}/edit', [CityController::class, 'edit'])-> name('cities.edit');
        Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.destroy');

        Route::post('/hotel_types', [HotelTypeController::class, 'store'])-> name('hotel_types.store');
        Route::put('/hotel_types/{id}', [HotelTypeController::class, 'update'])-> name('hotel_types.update');
        Route::get('/hotel_types/create', [HotelTypeController::class, 'create'])-> name('hotel_types.create');
        Route::get('/hotel_types/{id}/edit', [HotelTypeController::class, 'edit'])-> name('hotel_types.edit');
        Route::delete('/hotel_types/{id}', [HotelTypeController::class, 'destroy'])-> name('hotel_types.destroy');

        Route::post('/hotels', [HotelController::class, 'store'])-> name('hotels.store');
        Route::put('/hotels/{id}', [HotelController::class, 'update'])-> name('hotels.update');
        Route::get('/hotels/create', [HotelController::class, 'create'])-> name('hotels.create');
        Route::get('/hotels/{id}/edit', [HotelController::class, 'edit'])-> name('hotels.edit');
        Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])-> name('hotels.destroy');

        Route::post('/promotions', [PromotionController::class, 'store'])-> name('promotions.store');
        Route::put('/promotions/{id}', [PromotionController::class, 'update'])-> name('promotions.update');
        Route::get('/promotions/create', [PromotionController::class, 'create'])-> name('promotions.create');
        Route::get('/promotions/{id}/edit', [PromotionController::class, 'edit'])-> name('promotions.edit');
        Route::delete('/promotions/{id}', [PromotionController::class, 'destroy'])-> name('promotions.destroy');

        Route::get('/service_types/create', [ServiceTypeController::class, 'create'])-> name('service_types.create');
        Route::get('/service_types/{id}/edit', [ServiceTypeController::class, 'edit'])-> name('service_types.edit');
        Route::post('/service_types', [ServiceTypeController::class, 'store'])-> name('service_types.store');
        Route::put('/service_types/{id}', [ServiceTypeController::class, 'update'])-> name('service_types.update');
        Route::delete('/service_types/{id}', [ServiceTypeController::class, 'destroy'])-> name('service_types.destroy');

        Route::get('/hotels/create', [HotelController::class, 'create'])-> name('hotels.create');
        Route::get('/hotels/{id}/edit', [HotelController::class, 'edit'])-> name('hotels.edit');
        Route::post('/hotels', [HotelController::class, 'store'])-> name('hotels.store');
        Route::put('/hotels/{id}', [HotelController::class, 'update'])-> name('hotels.update');
        Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])-> name('hotels.destroy');

        Route::post('/room_types', [RoomTypeController::class, 'store'])-> name('room_types.store');
        Route::put('/room_types/{id}', [RoomTypeController::class, 'update'])-> name('room_types.update');
        Route::get('/room_types/create', [RoomTypeController::class, 'create'])-> name('room_types.create');
        Route::get('/room_types/{id}/edit', [RoomTypeController::class, 'edit'])-> name('room_types.edit');
        Route::delete('/room_types/{id}', [RoomTypeController::class, 'destroy'])-> name('room_types.destroy');

        Route::post('/rooms', [RoomController::class, 'store'])-> name('rooms.store');
        Route::put('/rooms/{id}', [RoomController::class, 'update'])-> name('rooms.update');
        Route::get('/rooms/create', [RoomController::class, 'create'])-> name('rooms.create');
        Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])-> name('rooms.edit');
        Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])-> name('rooms.destroy');

        Route::get('/accounts', [AccountController::class, 'index'])-> name('accounts.index');
        Route::post('/accounts', [AccountController::class, 'store'])-> name('accounts.store');
        Route::put('/accounts/{id}', [AccountController::class, 'update'])-> name('accounts.update');
        Route::get('/accounts/create', [AccountController::class, 'create'])-> name('accounts.create');
        Route::get('/accounts/{id}/edit', [AccountController::class, 'edit'])-> name('accounts.edit');
        Route::delete('/accounts/{id}', [AccountController::class, 'destroy'])-> name('accounts.destroy');

        Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])-> name('bookings.destroy');
    });


    

   

    
});


// Chức năng đăng ký 1 User mới
// Route::get('/register', [RegisterController::class, 'showForm'])->name('admin.register');
// Route::post('/register', [RegisterController::class, 'handleForm'])->name('admin.handle-register');



?>