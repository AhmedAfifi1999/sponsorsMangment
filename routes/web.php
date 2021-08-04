<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\register;
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
    return view('welcome');
});
Route::get('/register',[register::class,'index'])->name('register');
Route::post('/registerFunction',[register::class,'register'])->name('registerFunction');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::redirect('home2','/pm/app/modules/admin/views/home.html');

Route::redirect('login','login.html');

