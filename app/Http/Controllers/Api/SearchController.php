<?php

namespace App\Http\Controllers\Api;

use App\Block;
use App\Http\Controllers\Controller;
use App\Message;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        $users = User::all();
        $data = [];

        $gender = "";
        if($request->gender == 'male')
            $gender = "female";
        else
            $gender = "male";

        $users = $users->where('gender',$gender);
        $users = $users->where('profileStatus',1);

        if($request->search['nationality'] != '') {
            $users = $users->where('nationality',$request->search['nationality']);
        }
        if($request->search['country'] != '') {
            $users = $users->where('country',$request->search['country']);
        }
        if($request->search['status'] != '') {
            $users = $users->where('status',$request->search['status']);
        }
        if($request->search['study'] != '') {
            $users = $users->where('study',$request->search['study']);
        }
        if($request->search['ethnicity'] != '') {
            $users = $users->where('ethnicity',$request->search['ethnicity']);
        }
        if($request->search['weight_from'] != '' && $request->search['weight_to'] != '') {
            $users = $users->whereBetween('weight',[$request->search['weight_from'],$request->search['weight_to']]);
        }
        if($request->search['length_from'] != '' && $request->search['length_to'] != '') {
            $users = $users->whereBetween('length',[$request->search['length_from'],$request->search['length_to']]);
        }

        $counter = 0;
        if($request->search['religion'] != '')
            $counter++;
        if($request->search['skin'] != '')
            $counter++;
        if($request->search['financial'] != '')
            $counter++;

        foreach ($users as $user) {
            $c = 0;
            if($request->search['religion'] != '') {
                if(isset($user->profile->religion) && $user->profile->religion == $request->search['religion']) {
                    $c++;
                }
            }
            if($request->search['skin'] != '') {
                if(isset($user->profile->skin) && $user->profile->skin == $request->search['skin']) {
                    $c++;
                }
            }
            if($request->search['financial'] != '') {
                if(isset($user->profile->financial) && $user->profile->financial == $request->search['financial']) {
                    $c++;
                }
            }
            $b = Block::where([
                ['user_id',$request->my_id],
                ['blocked',$user->id]
            ])->orWhere([
                ['user_id',$user->id],
                ['blocked',$request->my_id]
            ])->first();

            if(!$b) $c++;

            if($c > $counter)
                $data[] = $user;
        }

        return $data;
    }

    public function checkIfHasChatWith(Request $request) {
        return Message::where([
            ['from_id',$request->my_id],
            ['to_id',$request->user_id]
        ])->orWhere([
            ['from_id',$request->user_id],
            ['to_id',$request->my_id],
        ])->count();
    }
}
