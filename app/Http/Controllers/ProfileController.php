<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = auth()->user();
        return view('profile',['user' => $user]);
    }

    public function complete() {
        $user = auth()->user();
        if($user->profile) {
            return redirect()->route('profile.index');
        }
        return view('complete',['user' => $user]);
    }

    public function complete_action(Request $request) {
        $data = [];
        if(auth()->user()->gender == 'female') {
            $data = $request->validate([
                'skin' => 'required',
                'religion' => 'required',
                'smoking' => 'required',
                'financial' => 'required',
                'financial_plus' => 'required',
                'body' => 'required',
                'marriage_method' => 'required',
                'future_living' => 'required'
            ]);
        } else {
            $data = $request->validate([
                'skin' => 'required',
                'religion' => 'required',
                'smoking' => 'required',
                'financial' => 'required',
                'financial_plus' => 'required',
                'body' => 'required',
                'marriage_method' => 'required',
            ]);
        }

        $profile = new Profile();
        $profile->skin = $data['skin'];
        $profile->religion = $data['religion'];
        $profile->smoking = $data['smoking'];
        $profile->financial = $data['financial'];
        $profile->financial_plus = $data['financial_plus'];
        $profile->body = $data['body'];
        $profile->marriage_method = $data['marriage_method'];
        if(auth()->user()->gender == 'female')
            $profile->future_living = $data['future_living'];
        $profile->user_id = auth()->id();
        $profile->save();
        return redirect()->route('profile.index');
    }
}
