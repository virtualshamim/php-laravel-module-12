<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LocationController;

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

Route::get('/', function () {
    return view('welcome');
})->name('/');
Route::group([],function () {
    //Buses
    Route::get('/all-buses', [BusController::class, 'index'])->name('all-buses');
    Route::post('/new-bus', [BusController::class, 'store'])->name('new-bus');
    Route::put('/all-buses', [BusController::class, 'update'])->name('bus-update');
    Route::delete('/all-buses', [BusController::class, 'destroy'])->name('bus-delete');
    Route::get('/get-bus-details/{busId}', [BusController::class, 'getBusDetails']);
    //Locations
    Route::get('/all-locations', [LocationController::class, 'index'])->name('all-locations');
    Route::post('/new-location', [LocationController::class, 'store'])->name('new-location');
    Route::put('/all-locations/{locationID}', [LocationController::class, 'update']);
    Route::delete('/all-locations/{locationID}', [LocationController::class, 'destroy']);
    Route::get('/get-location-details/{locationId}', [LocationController::class, 'getLocationDetails']);
    //Trips
    Route::get('/all-trips', [TripController::class, 'index'])->name('all-trips');
    Route::post('/new-trip', [TripController::class, 'store'])->name('new-trip');
    Route::put('/all-trips/{tripID}', [TripController::class, 'update']);
    Route::delete('/all-trips/{tripID}', [TripController::class, 'destroy']);
    Route::get('/get-trip-details/{tripId}', [TripController::class, 'getTripDetails']);
    //Booking
    Route::get('/all-bookings', [BookingController::class, 'index'])->name('all-bookings');
    Route::post('/new-booking', [BookingController::class, 'store'])->name('new-booking');
    Route::put('/all-bookings/{bookingID}', [BookingController::class, 'update']);
    Route::delete('/all-bookings/{bookingID}', [BookingController::class, 'destroy']);
    Route::get('/get-bookinh-details/{bookingId}', [BookingController::class, 'getBookingDetails']);

});
