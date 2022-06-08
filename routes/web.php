<?php
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {

        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /////subscribers
        Route::get('/index', [SubscriberController::class, 'index']);
        Route::post('/store', [SubscriberController::class, 'store'])->name('store');
        Route::get('/fetchall', [SubscriberController::class, 'fetchAll'])->name('fetchAll');
        Route::delete('/delete', [SubscriberController::class, 'delete'])->name('delete');
        Route::get('/edit', [SubscriberController::class, 'edit'])->name('edit');
        Route::post('/update', [SubscriberController::class, 'update'])->name('update');       
       
        //logout
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});


Route::group(['middleware' => ['auth', 'isAdmin']], function() {
    //create user
    Route::get('/register-user', [RegisterController::class, 'show'])->name('register-user.show');
    Route::post('/register-user', [RegisterController::class, 'register'])->name('register-user.perform');
});

        
         
 