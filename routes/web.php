<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


//==========================Admin Login Route==============================//
Route::get('admin/login','Auth\AdminAuthController@getLogin')->name('adminLogin');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin')->name('adminLoginPost');
Route::get('admin/logout', 'Auth\AdminAuthController@logout')->name('adminLogout');

//==========================Admin Registration Route==============================//
Route::get('admin/registration','Auth\AdminAuthController@getRegister')->name('adminRegister');
Route::post('admin/registration', 'Auth\AdminAuthController@postRegister')->name('adminRegisterPost');


Route::group(['prefix' => 'admin','middleware' => 'adminauth'], function (){
    Route::get('dashboard','AdminController@dashboard')->name('dashboard');	
    Route::get('calendar','AdminCalenderController@index')->name('calendar');
    Route::post('calendarAjax','AdminCalenderController@ajax')->name('ajaxcalendar');
    Route::get('profile','AdminController@profile')->name('Admin-Profile');
    Route::post('profile/store','AdminController@storeprofile')->name('Admin-Profile-Store');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
        Route::view('/login', 'dashboard.user.login')->name('login');
        Route::view('/register', 'dashboard.user.register')->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
        Route::view('/home', 'dashboard.user.home')->name('home');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
});

