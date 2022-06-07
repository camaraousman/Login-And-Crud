<?php
use App\Http\Controllers\SubscriberController;
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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {

        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});


        /////subscribers
        Route::get('/index', [SubscriberController::class, 'index']);
        Route::post('/store', [SubscriberController::class, 'store'])->name('store');
        Route::get('/fetchall', [SubscriberController::class, 'fetchAll'])->name('fetchAll');
        Route::delete('/delete', [SubscriberController::class, 'delete'])->name('delete');
        Route::get('/edit', [SubscriberController::class, 'edit'])->name('edit');
        Route::post('/update', [SubscriberController::class, 'update'])->name('update');