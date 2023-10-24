<?php

use App\Events\MessageNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('listen');
});

// Route::get('/event', function () {
//     event(new MessageNotification("this is our event"));
// });

Route::post('/message', [Controller::class, 'sendMessage']);

Route::get('/admin', function () {
    return view('admin');
});





