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

// Route::get('mailable', function () {
//     $invoice = App\Post::find(1);

//     return new App\Mail\SendMailPublished($invoice, 'preciousone@computer4u.com');
// });

Route::get('unsubscribe/{mail}', 'SubscribersController@unsubscribe')->name('unsubscribe');

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');

// Auth::routes();


//Route::get('/home', 'HomeController@index')->name('home');
