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
Route::post('v1/login','UserController@login');

Route::group(['middleware' => ['auth:api']], function () {
  //data yang dibutuhkan
   Route::get('v1/counter/all','DataController@data_dashboard');
  //Bagian User 
    Route::get('v1/user/','userController@index');
    ROute::post('v1/user/','userController@register');
    Route::get('v1/user/reset/{user}','userController@reset_password');
    Route::put('v1/user/change/{user}','userCOntroller@ganti_password');
    
   //Baigan Obat
    Route::get('v1/obat/','obatController@index_obat'); 
    Route::post('v1/obat','obatController@new_obat');
    Route::delete('v1/obat','obatController@delete_obat');
    Route::get('v1/obat/{obat}','obatController@show_obat');
    Route::put('v1/obat/{obat}','obatController@edit_obat');
    //isi stok dan transaksi obat
    Route::post('v1/obat/stok/{obat}','obatController@new_stok');
    Route::post('v1/obat/keluar/{stok}','obatController@keluar_data');
    Route::get('v1/transaksi/obat/masuk','obatController@index_masuk');
    Route::get('v1/transaksi/obat/keluar','obatController@index_keluar');
    Route::delete('v1/stok/hapus','obatController@hapus_stok');
   //dokter
    Route::post('v1/dokter/new','DokterController@store_dokter');
    Route::put('v1/dokter/{dok}','DokterController@update_dokter');
    Route::get('v1/dokter/{dok}','DokterController@show_dokter');
    Route::get('v1/dokter','DokterController@index_dokter');
    Route::delete('v1/dokter/{dok}','DokterController@delete_dokter');

    
  //pasien
  
  //rekam medis
  
  //api auth
    Route::get('v1/auth','LoginController@data_user');
    Route::get('v1/jadwal/today','DokterController@jadwal_hari_ini');

});