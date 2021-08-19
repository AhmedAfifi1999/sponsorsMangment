<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Admin\enterpriseSponsorController;
use App\Http\Controllers\Admin\PersonalSposorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PersonalSponser\PersonalSposorUserController as pSponsorUser;
use App\Http\Controllers\PersonalSponser\PersonalSponsorController as pSponsor;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SMSController;
use App\Http\Controllers\GuaranteedController;
use App\Http\Controllers\Enterprise\EnterpriseUserController;
use App\Http\Controllers\Enterprise\EnterpriseController;
use App\Http\Controllers\Guaranteed\GuaranteedController as GuaranteedCtrl;

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
//----Guaranteed---
/*
Route::post('Guaranteed', [GuaranteedCtrl::class, 'store'])->name('Guaranteed.store');
Route::put('Guaranteed/{id}', [GuaranteedCtrl::class, 'update'])->name('Guaranteed.update');
*/
Route::resource('Guaranteed', GuaranteedCtrl::class);
Route::put('search/personal/{id}/guaranteed', [GuaranteedCtrl::class, 'personalFilter']);
Route::get('show/personal/guaranteed/{id}', [GuaranteedCtrl::class, 'personalGuaranteed']);

//-------

Route::post('personalSponsor/register', [pSponsorUser::class, 'register']);
Route::post('enterprise/register', [EnterpriseUserController::class, 'register']);

Route::get('location', [pSponsor::class, 'locationInfo'])->name('location_info');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login'])->name('login');


Route::group(['prefix' => 'personalSponsor'], function () {
    Route::post('login', [pSponsorUser::class, 'login']);
});

Route::get('personalSponsor/{id}', [PersonalSposorController::class, 'show']);


Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('showPersonalSponsors', [PersonalSposorController::class, 'index']);
    Route::get('showEnterpriseSponsors', [enterpriseSponsorController::class, 'index']);
    Route::post('searchPersonalSponsor', [SearchController::class, 'searchPersonalSponsor']);
    Route::post('searchEnterpriseSponsor', [SearchController::class, 'searchEnterpriseSponsor']);
    Route::post('sendMassagePersonalSponsor', [SMSController::class, 'sendMassagePersonalSponsor']);

//    //Guaranteeds
//    Route::post('store/guaranteed',[GuaranteedController::class,'store']);
//    Route::get('show/guaranteed/{id}',[GuaranteedController::class,'show']);
//    Route::post('update/guaranteed',[GuaranteedController::class,'update']);


});

Route::post('send/sms/personalSponsor', [SMSController::class, 'sendMassagePersonalSponsor'])->name('send.personalSponsor');
Route::put('updatePersonalSponsorsInfo/{id}', [pSponsor::class, 'update']);

Route::group(['middleware' => ['auth:personal_sponsor']], function () {
    Route::get('showPersonalSponsorsInfo', [pSponsor::class, 'index']);


});

Route::resource('enterprise', EnterpriseController::class);
