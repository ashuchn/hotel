<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

// Route::get('dashboard/{location?}', [HotelController::class, 'dashboard'])->name('dashboard');
Route::get('dashboard/', [HotelController::class, 'dashboard'])->name('dashboard');
//Route::post('dashboard/hotels', [HotelController::class, 'showHotels'])->name('showHotels');
Route::any('dashboard/hotels/{location?}', [HotelController::class, 'showHotels'])->name('showHotels');

Route::get('hotel_images/id/{hotelId}', [HotelController::class, 'getHotelImages'])->name('hotelImages');

Route::get('hotel_details/id/{hotelId}', [HotelController::class, 'hotelDetails'])->name('hotelDetails');

