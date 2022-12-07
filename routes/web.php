<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\ManufactoryController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\BondController;
use App\Http\Controllers\ShareholderController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentDetailsController;
use App\Http\Controllers\TransportationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HekalController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\ItineraryDetailsController;

/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::GET('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::GET('bond/withdraw', [BondController::class, 'withdraw'])->name('bond.withdraw');
Route::GET('bond/funds_movement', [BondController::class, 'funds_movement'])->name('bond.funds_movement');
Route::GET('/', [IndexController::class, 'index']);
Route::GET('coupons/used', [CouponController::class, 'used'])->name('coupon.used');
Route::GET('coupons/unused', [CouponController::class, 'unused'])->name('coupon.unused');
Route::GET('coupons/unused', [CouponController::class, 'unused'])->name('coupon.unused');
Route::GET('ajaxGetClients', [HekalController::class, 'ajaxGetClients'])->name('ajaxGetClients');
Route::GET('ClientsOfItinerary', [HekalController::class, 'ClientsOfItinerary'])->name('ClientsOfItinerary');
Route::GET('personBonds', [HekalController::class, 'personBonds'])->name('personBonds');
Route::GET('ajaxGetCoupons', [HekalController::class, 'ajaxGetCoupons'])->name('ajaxGetCoupons');
Route::GET('GetClientsOFShipment', [HekalController::class, 'GetClientsOFShipment'])->name('GetClientsOFShipment');
Route::GET('last100', [ShipmentDetailsController::class, 'last100'])->name('ShipmentDetails.last100');
Route::GET('expenses/last100', [ExpenseController::class, 'last100'])->name('expense.last100');
Route::GET('expense_by_period', [ExpenseController::class, 'expense_by_period'])->name('expense_by_period');
Route::GET('expense_between_dates', [ExpenseController::class, 'expense_between_dates'])->name('expense_between_dates');
Route::GET('clients_by_city', [HekalController::class, 'clients_by_city'])->name('clients_by_city');
Route::GET('clients/client_movements/{id}', [HekalController::class, 'client_movements'])->name('client_movements');
Route::GET('transportation_movements/{id}', [TransportationController::class, 'transportation_movements'])->name('transportation_movements');
Route::GET('itinerary_collecting/{id}', [HekalController::class, 'itinerary_collecting'])->name('itinerary_collecting');

Route::get('test',  [HekalController::class, 'test']);
Route::get('representative/itinerary_of_representative/{representative}',
                [RepresentativeController::class, 'itinerary_of_representative'])
                ->name('representative.itinerary_of_representative');

Route::POST('fetch_cities', [HekalController::class, 'fetch_cities'])->name('fetch_cities');
Route::POST('shareholder_bonds', [BondController::class, 'shareholder_bonds'])->name('shareholder_bonds');
Route::POST('ClientsOfRepresentative', [HekalController::class, 'ClientsOfRepresentative'])->name('ClientsOfRepresentative');
Route::POST('couponsOfTransportation', [HekalController::class, 'couponsOfTransportation'])->name('couponsOfTransportation');

// Route::get('last100', ShipmentDetailsController::class, 'test_func');
// Route::post('shipmentDetails.last100', ShipmentDetailsController::class, 'last100')->name('last100');
// Route::get('shipmentDetails/last100', ShipmentDetailsController::class, 'last100')->name('last100');
// Route::post('shipmentDetails/last100', ShipmentDetailsController::class, 'last100')->name('last100');

Route::resource('bank', BankController::class);
Route::resource('bond', BondController::class);
Route::resource('hekal', HekalController::class);
Route::resource('client', ClientController::class);
Route::resource('coupon', CouponController::class);
Route::resource('driver', DriverController::class);
Route::resource('expense', ExpenseController::class);
Route::resource('shipment', ShipmentController::class);
Route::resource('itinerary', ItineraryController::class);
Route::resource('expenseType', ExpenseTypeController::class);
Route::resource('manufactory', ManufactoryController::class);
Route::resource('shareholder', ShareholderController::class);
Route::resource('representative', RepresentativeController::class);
Route::resource('transportation', TransportationController::class);
Route::resource('shipmentDetails', ShipmentDetailsController::class);
Route::resource('itineraryDetails', ItineraryDetailsController::class);
