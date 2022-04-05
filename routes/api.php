<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Save Register
Route::post('/register/save','Auth\RegisterController@save')->name('register.save');

// Get My Profile
Route::get('/my-profile/{id}','Api\ProfileController@myProfile');

// Get User Profile
Route::get('/profile/{id}/{myId}','Api\ProfileController@getProfile');

// Get User Profile
Route::post('/profile-details','Api\ProfileController@getProfileDetails');

// Change Profile Status
Route::post('/change-profile-status','Api\ProfileController@changeProfileStatus');

// Complete Profile Action
Route::post('/complete-profile','Api\ProfileController@complete_profile_action');

// Activation Account Action
Route::post('/activate','Api\ProfileController@activate');

// Change Password Action
Route::post('/change-password','Api\ProfileController@changePassword');

// Edit Profile Action
Route::post('/edit-profile','Api\ProfileController@editProfile');

// Edit Interests Action
Route::post('/edit-interests','Api\ProfileController@editInterests');

// Change User Image
Route::post('/change-image','Api\ProfileController@changeImage');

// Send Image
Route::post('/send-image','Api\ProfileController@sendImage');

// Get User's Contacts
Route::get('/get-contacts/{id}','Api\ChatController@get_contacts');

// Get User's Conversation
Route::get('/get-conversation/{userId}/{myId}','Api\ChatController@get_conversation');

// Save New Message
Route::post('/save-message','Api\ChatController@save_message');

// Send New Request
Route::post('/send-request','Api\ProfileController@send_request');

// Get Pending Requests
Route::get('/get-pending-requests/{id}','Api\ProfileController@get_pending_requests');

// Send Reject Reason
Route::post('/send-reject-reason','Api\ProfileController@send_reject_reason');

// Send First Accept
Route::post('/send-first-accept','Api\ProfileController@send_first_accept');

// Get User Gender
Route::get('/get-user-gender/{id}','Api\ProfileController@get_user_gender');

/*
=======================
    Active Requests
=======================
*/

// Get Active Requests
Route::get('/get-active-requests/{id}','Api\ProfileController@get_active_requests');

// Cancel Active Request
Route::post('/cancel-request','Api\ProfileController@cancel_request');

// Male Requests
Route::get('/get-male-requests/{id}','Api\ProfileController@get_male_requests');

// Get Male Dates
Route::get('/get-dates/{id}','Api\ProfileController@get_dates');

// Select Date
Route::post('/select-date','Api\ProfileController@select_date');

/*
=======================
    Block Area
=======================
*/

// Get Blocked Users
Route::get('/get-blocked/{id}','Api\ProfileController@get_blocked');
// Block User
Route::post('/block-user','Api\ProfileController@block_user');
// Cancel Block
Route::post('/cancel-block','Api\ProfileController@cancel_block');
/*
=======================
    Messages
=======================
*/
Route::get('/get-new-messages/{id}','Api\ChatController@get_new_messages');
Route::get('/mark-messages-as-read/{from}/{to}','Api\ChatController@mark_messages_as_read');
/*
=======================
    Search Area
=======================
*/
Route::post('/search','Api\SearchController@index');
Route::post('/check-chat','Api\SearchController@checkIfHasChatWith');
/*
=======================
    Notifications Area
=======================
*/
Route::get('/get-notifications/{id}','Api\ProfileController@get_notifications');
Route::post('/get-notifications-mark','Api\ProfileController@get_notifications_mark');
/*
=======================
    Mail Area
=======================
*/
Route::get('/get-mail','Api\ProfileController@get_mail');
