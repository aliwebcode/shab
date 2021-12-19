<?php

use Illuminate\Support\Facades\Route;


//Route::get('/', function () {
//    return view('register');
//});

Auth::routes(['verify' => true]);

Route::get('/join', 'Auth\RegisterController@index')->name('register.index');
//Route::get('/profile/{id}','Api\ProfileController@index');

Route::get('/profile', function () {
    return redirect('/profile/me');
});
Route::get('/', function () {
    return redirect('/profile/me');
});
Route::get('/home', function () {
    return redirect('/profile/me');
});

Route::get('/logout', function () {
    auth()->logout();
    return redirect("/login");
});

//Route::get('/test/{l}','HomeController@test');

Route::get('/{any}/{id?}', 'HomeController@index')
    ->where('any', '^(?!admin).*$')
    ->name('home');
// Login Page
//Route::get('/login','Auth\LoginController@index')->name('login');
// Login Action
//Route::post('/login','Auth\LoginController@login')->name('login.action');
// Profile Page
//Route::get('/profile', 'ProfileController@index')->name('profile.index');
//// Profile Complete Page
//Route::get('/profile/complete', 'ProfileController@complete')->name('profile.complete');
//// Profile Complete Action
//Route::post('/profile/complete', 'ProfileController@complete_action')->name('profile.complete.action');
