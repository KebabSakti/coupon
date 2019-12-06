<?php

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
    return redirect()->route('public.index');
});

//admin login
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', 'AuthController@login')->name('auth.login');
    Route::post('login', 'AuthController@submitLogin')->name('auth.submit.login');
    Route::get('logout', 'AuthController@logout')->name('auth.logout');
});

//public route
Route::group(['prefix' => 'public'], function () {
    Route::get('index', 'AppController@index')->name('public.index');
    Route::get('history/{id?}', 'AppController@history')->name('public.history');
    Route::post('search', 'AppController@search')->name('public.search');
});

//admin route
Route::group(['prefix' => 'admin'], function () {
    Route::get('transaksi', 'TransaksiController@index')->name('admin.transaksi.index');
    Route::get('transaksi/data', 'TransaksiController@indexData')->name('admin.transaksi.index.data');

    Route::get('transaksi/coupon', 'TransaksiController@couponData')->name('admin.transaksi.coupon.data');
    Route::get('transaksi/{id}/coupon', 'TransaksiController@couponDetail')->name('admin.transaksi.coupon.detail');
    Route::get('transaksi/{id}/data/coupon', 'TransaksiController@couponDetailData')->name('admin.transaksi.coupon.detail.data');
    Route::get('transaksi/{id}/hapus/coupon', 'TransaksiController@hapusCoupon')->name('admin.transaksi.coupon.hapus');

    Route::get('transaksi/{id}', 'TransaksiController@detail')->name('admin.transaksi.detail');
    Route::get('transaksi/{id}/data', 'TransaksiController@detailData')->name('admin.transaksi.detail.data');
    Route::get('transaksi/{id}/hapus', 'TransaksiController@hapus')->name('admin.transaksi.hapus');
    Route::get('customer/dt', 'CustomerController@customerDT')->name('customer.index.dt');
    Route::get('redeem', 'PointController@index')->name('point.index');
    Route::post('redeem/point', 'PointController@redeemPoint')->name('point.redeem.point');
    Route::post('redeem/coupon', 'PointController@redeemCoupon')->name('point.redeem.coupon');
    Route::get('redeem/{customer_id}/print', 'PointController@printCoupon')->name('point.print.coupon');
    
    Route::match(['post', 'put'], 'rule/{id}/coupon', 'RuleController@couponRule')->name('rule.coupon');
    Route::resource('customer', 'CustomerController');
    Route::resource('rule', 'RuleController');
});