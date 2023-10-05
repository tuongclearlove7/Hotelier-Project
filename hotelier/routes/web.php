<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingDetailController;
use App\Http\Controllers\BookingReceiptController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\OurRoomController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RemoveSessionController;
use App\Http\Controllers\SaveSessionController;
use App\Http\Controllers\SumController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::webhooks('webhook-receiving-url');

Route::get('/', [HomeController::class, 'index'])-> name('home');


Route::get('/bookings', [BookingController::class, 'index'])-> name('bookings.index');
Route::post('/bookings', [BookingController::class, 'store'])-> name('bookings.store');
Route::put('/bookings/{id}', [BookingController::class, 'update'])-> name('bookings.update');


Route::get('/hotels', [HotelController::class, 'index'])-> name('hotels.index');
Route::post('/hotels', [HotelController::class, 'store'])-> name('hotels.store');
Route::get('/hotels/{id}', [HotelController::class, 'show'])-> name('hotels.show');
Route::get('/hotels/hotel_detail/{id}', [HotelController::class, 'hotel_detail'])-> name('hotels.hotel_detail');


Route::get('/OurRooms', [OurRoomController::class, 'index'])-> name('our_rooms.index');
Route::post('/OurRooms', [OurRoomController::class, 'store'])-> name('our_rooms.store');
Route::get('/OurRooms/{id}', [OurRoomController::class, 'show'])-> name('our_rooms.show');
Route::get('/OurRooms/room_detail/{id}', [OurRoomController::class, 'room_detail'])-> name('our_rooms.room_detail');


Route::get('/booking_details', [BookingDetailController::class, 'index'])-> name('booking_details.index');
Route::get('/booking_details/{id}', [BookingDetailController::class, 'show'])->name('booking_details.show')->middleware('role_user_key');
Route::post('/booking_details', [BookingDetailController::class, 'store'])-> name('booking_details.store');
Route::post('booking_details/remove/{room_id}', [BookingDetailController::class, 'remove'])->name('booking_details.remove');
Route::post('/cancel_booking_receipt', [BookingReceiptController::class, 'store'])-> name('cancel_booking_receipt.store');


Route::get('/contacts', [ContactController::class, 'index'])-> name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])-> name('contacts.store');

Route::get('/payments', [PaymentController::class, 'index'])-> name('payments.index');
Route::post('/payments', [PaymentController::class, 'store'])-> name('payments.store');
Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('payments.vnpay_payment');
Route::get('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('payments.vnpay_payment');


Route::post('/save_session', [SaveSessionController::class, 'saveIDToSession'])->name('save_session.saveIDToSession');
Route::post('/remove_session', [RemoveSessionController::class, 'removeIDFromSession'])->name('remove_session.removeIDFromSession');


require __DIR__.'/admin.php';









