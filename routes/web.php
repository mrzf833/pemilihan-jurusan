<?php

use App\models\Role;
use App\User;
use Illuminate\Support\Facades\DB;
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
Route::group(['middleware' => 'auth'],function(){
    Route::get('home',function(){
        if(auth()->user()->role->role === 'admin'){
            return redirect()->route('admin.dashboard');
        }else if(auth()->user()->role->role === 'siswa'){
            return redirect()->route('siswa.pemilihanJurusan');
        }
    });
    Route::group(['prefix' => 'admin'],function(){
        Route::get('/dashboard','DashboardController')->name('admin.dashboard');
        Route::get('','DashboardController')->name('admin.dashboard');
    
        Route::group(['prefix' => 'kelas'],function(){
            Route::get('','KelasController@index')->name('admin.kelas.index');
            Route::post('','KelasController@store')->name('admin.kelas.store');
            Route::patch('{kelas:id}','KelasController@edit')->name('admin.kelas.edit');
            Route::delete('{kelas:id}','KelasController@destroy')->name('admin.kelas.destroy');
        });
    
        Route::group(['prefix' => 'jurusan'],function(){
            Route::get('','JurusanController@index')->name('admin.jurusan.index');
            Route::post('','JurusanController@store')->name('admin.jurusan.store');
            Route::patch('{jurusan:id}','JurusanController@edit')->name('admin.jurusan.edit');
            Route::delete('{jurusan:id}','JurusanController@destroy')->name('admin.jurusan.destroy');
        });
    
        Route::group(['prefix' => 'pembagian-jurusan'],function(){
            Route::get('','PembagianJurusanController@index')->name('admin.pembagian_jurusan.index');
            Route::post('','PembagianJurusanController@store')->name('admin.pembagian_jurusan.store');
            Route::patch('{kelas_jurusan:id}','PembagianJurusanController@edit')->name('admin.pembagian_jurusan.edit');
            Route::delete('{kelas_jurusan:id}','PembagianJurusanController@destroy')->name('admin.pembagian_jurusan.destroy');
        });
    
        Route::group(['prefix' => 'user'],function(){
            Route::get('','UserController@index')->name('admin.user.index');
            Route::get('/create','UserController@create')->name('admin.user.create');
            Route::post('','UserController@store')->name('admin.user.store');
            Route::get('/{user:id}','UserController@show')->name('admin.user.show');
            Route::patch('/{user:id}','UserController@edit')->name('admin.user.edit');
            Route::delete('/{user:id}','UserController@destroy')->name('admin.user.destroy');
        });
    });
    
    Route::get('search_jurusan','Helper\SearchJurusan@search')->name('search_jurusan');
    
    Route::group(['middleware' => 'siswa'],function(){
        Route::get('profile','Siswa\UserController@index')->name('siswa.profile');
        Route::get('profile/edit','Siswa\UserController@show')->name('siswa.show');
        Route::patch('profile/edit','Siswa\UserController@edit')->name('siswa.edit');
        Route::get('pemilihan_jurusan','Siswa\UserController@pemilihanJurusan')->name('siswa.pemilihanJurusan');
        Route::patch('pemilihan_jurusan','Siswa\UserController@jurusan')->name('siswa.jurusan');
    });
});


Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout')->name('logout');
