<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }

    // Check if User Code Exists
    function codeExists($code) {
        return User::where('user_code',$code)->exists();
    }
    // Generate New Code
    function generateCode() {
        $code = Str::random(6);
        if($this->codeExists($code)) {
            return $this->generateCode();
        }
        return $code;
    }

    public function save(Request $request)
    {
        $user = new user();
        $user->user_code = $this->generateCode();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->nationality = $request->nationality;
        $user->country = $request->country;
        $user->status = $request->status;
        $user->birthday = $request->birthday;
        $user->length = $request->length;
        $user->weight = $request->weight;
        $user->ethnicity = $request->ethnicity;
        $user->study = $request->study;
        $user->employee = $request->employee;
        $user->avatar = $request->avatar;
        $user->phone = $request->phone;
        $user->userDescription = $request->userDescription;
        $user->partnerDescription = $request->partnerDescription;
        if(isset($request->image)) {
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $imageName = time() . 'thumbnails.' . $imageExt;
            $request->file('image')->storeAs('public/images', $imageName);
            $user->image = $imageName;
        }
        if (isset($request->ethnicity_parent)) {
            $user->ethnicity_parent = $request->ethnicity_parent;
        }
        $user->save();
        return response()->json(1);
    }
}
