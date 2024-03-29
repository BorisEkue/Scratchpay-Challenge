<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes
Route::post('v1/businessDates/isBusinessDay', 'SettlementDateController@isBusinessDay');
Route::post('v1/businessDates/getSettlementDate', 'SettlementDateController@getSettlementDate');
Route::get('v1/businessDates/getSettlementDate', 'SettlementDateController@getSettlementDate');

Route::get('v1/businessDates/publish', function (Request $request) {

    Redis::publish('BankWire', json_encode($request->json()));
});
