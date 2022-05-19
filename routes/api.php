<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// authentication
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('notification', function () {
    sendnotification('cWxoD401Sgidj5wLmPImWn:APA91bHY4heCY7a5ONNhPzhbDr2ZBLRv5WPxOEqkb0A7ZcVGrZQK7c6eButzRvMPd4DpSq-tK5l94BTT20KXAaXdsShxDw3y5dmPBEPpdolKt_mKE-ZPIxKKRskG3GxKmxd8NEMKuuYj',
        'test web', 'laravel');
    return 'done';
});

Route::middleware('auth:sanctum')->group(function () {
// authentication

    //log out
    Route::post('logout', [AuthController::class, 'logout']);
    //change user device token
    Route::get("DeviceToken/{token}",[AuthController::class,'sendDeviceToken']);
    //change user password
    Route::post('changePassword', [NewPasswordController::class, 'changePassword']);
    //update User Info
    Route::put('x', [AuthController::class, 'updateUserInfo']);
//home
    Route::post('home', [\App\Http\Controllers\BookController::class, 'getHomePage']);
    Route::post('addToFavorite/{id}', [\App\Http\Controllers\BookController::class, 'addToFav']);
    Route::get('favItems', [\App\Http\Controllers\BookController::class, 'getFav']);
    Route::post('AllMostListenedBooks', [\App\Http\Controllers\BookController::class, 'getAllMostListenedBooks']);
    Route::post('AllMostPublisedBooks', [\App\Http\Controllers\BookController::class, 'getAllMostPublisedBooks']);
    Route::get('DownloadBooks', [\App\Http\Controllers\LibraryController::class, 'getDownloadBooks']);
    Route::get('DownloadBooks/{id}', [\App\Http\Controllers\LibraryController::class, 'getCompletedBooks']);



    //post
    Route::apiResource('book', \App\Http\Controllers\BookController::class);
    //library
    Route::apiResource('library', \App\Http\Controllers\LibraryController::class);


});
//واجهات الاشتراك كيف نعملها
//شاشة المكتبة
//الراوتات
//التوكن بالريجيستر برجع نل

