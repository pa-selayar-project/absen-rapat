<?php

use Illuminate\Support\Facades\Route;

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
    return view('frontend.welcome');
});

Route::resource('absen-rapat', 'DetailController');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('home', 'HomeController@index')->name('home');
    
    Route::resource('absen', 'AbsenController');
    Route::get('absen/ajax/{id}', 'AbsenController@ajax');
    
    Route::resource('pegawai', 'PegawaiController');
    Route::get('pegawai/ajax/{id}', 'PegawaiController@ajax');
    
    Route::resource('ppnpn', 'HonorerController');
    Route::get('ppnpn/ajax/{id}', 'HonorerController@ajax');
    
    Route::resource('setelan/menu', 'MenuController');
    Route::get('setelan/menu/ajax/{id}', 'MenuController@ajax');
    
    Route::resource('setelan/jabatan', 'JabatanController');
    Route::get('setelan/jabatan/ajax/{id}', 'JabatanController@ajax');
    
    Route::resource('setelan/pangkat', 'PangkatController');
    Route::get('setelan/pangkat/ajax/{id}', 'PangkatController@ajax');
    
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});

