<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// Login Routes
Route::group(['namespace' => 'Admin','middleware' => 'guest:admin'],function (){
    Route::get('login','LoginController@getLogin')->name('get.admin.login');
    Route::post('login','LoginController@login')->name('admin.login');
});
Route::get('/',function () {
    return redirect()->route('admin.dashboard');
});
// Admin Routes
Route::group(['namespace' => 'Admin','middleware' => 'auth:admin'],function (){
    // Dashboard Page
    Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');

    /* Mail Area */

    // Mail Page
    Route::get('/mail','MailController@index')->name('admin.mail.index');
    // Add Mail Page
    Route::get('/mail/add','MailController@add')->name('admin.mail.add');
    // Save Mail Action
    Route::post('/mail/save','MailController@save')->name('admin.mail.save');
    // Delete Action
    Route::post('/mail/delete','MailController@delete')->name('admin.mail.delete');


    /* Activations Area */

    // Activations Page
    Route::get('/activations', 'ActivationsController@index')->name('admin.activations.index');
    // Activation Details
    Route::get('/activation/{id}', 'ActivationsController@show')->name('admin.activations.show');
    Route::post('/activation/change-status', 'ActivationsController@change_status')->name('admin.activations.change_status');

    /* Admin Area */

    // Profile Page
    Route::get('/profile','loginController@profile')->name('admin.profile');
    // Profile Edit Page
    Route::post('/profile','loginController@profileUpdate')->name('admin.profile.update');
    // Logout
    Route::get('/logout', 'loginController@logout')->name('admin.logout');
});
