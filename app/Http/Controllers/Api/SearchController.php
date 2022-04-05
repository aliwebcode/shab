<?php

namespace App\Http\Controllers\Api;

use App\Block;
use App\Http\Controllers\Controller;
use App\Message;
use App\Profile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        // All Requests
        $financial = $request->search['financial'];
        $nationality = $request->search['nationality'];
        $country = $request->search['country'];
        $religion = $request->search['religion'];
        $status = $request->search['status'];
        $ethnicity = $request->search['ethnicity'];
        $study = $request->search['study'];
        $skin = $request->search['skin'];
        $future_living = $request->search['future_living'];
        $age_from = $request->search['age_from'];
        $age_to = $request->search['age_to'];
        $weight_from = $request->search['weight_from'];
        $weight_to = $request->search['weight_to'];
        $length_from = $request->search['length_from'];
        $length_to = $request->search['length_to'];
        $employee = $request->search['employee'];
        $smoking = $request->search['smoking'];
        $body = $request->search['body'];
        $marriage_method = $request->search['marriage_method'];

        // Handle Ages
        $minDate = Carbon::today()->subYears($age_to);
        $maxDate = Carbon::today()->subYears($age_from)->endOfDay();

        $users = User::where([
            ['gender', '!=', $request->gender],
            ['profileStatus', 1]
        ])
            ->when($request->search['nationality'] != null, function ($q) use($nationality) {
            $q->where('nationality', $nationality);
        })->when($request->search['country'] != null, function ($q) use($country) {
            $q->where('country', $country);
        })->when($request->search['financial'] != null, function($q) use($financial) {
            $q->whereHas('profile', function ($b) use($financial) {
                $b->where('financial', $financial);
            });
        })->when($request->search['religion'] != null, function($q) use($religion) {
            $q->whereHas('profile', function ($b) use($religion) {
                $b->where('religion', $religion);
            });
        })->when($request->search['status'] != null, function($q) use($status) {
            $q->where('status', $status);
        })->when($request->search['ethnicity'] != null, function($q) use($ethnicity) {
            $q->where('ethnicity', $ethnicity);
        })->when($request->search['study'] != null, function($q) use($study) {
            $q->where('study', $study);
        })->when($request->search['skin'] != null, function($q) use($skin) {
            $q->whereHas('profile', function ($b) use($skin) {
                $b->where('skin', $skin);
            });
        })->when($request->search['future_living'] != null, function($q) use($future_living) {
            $q->whereHas('profile', function ($b) use($future_living) {
                $b->where('future_living', $future_living);
            });
        })->when($request->search['employee'] != null, function($q) use($employee) {
            $q->where('employee', $employee);
        })->when($request->search['smoking'] != null, function($q) use($smoking) {
            $q->whereHas('profile', function ($b) use($smoking) {
                $b->where('smoking', $smoking);
            });
        })->when($request->search['body'] != null, function($q) use($body) {
            $q->whereHas('profile', function ($b) use($body) {
                $b->where('body', $body);
            });
        })->when($request->search['marriage_method'] != null, function($q) use($marriage_method) {
            $q->whereHas('profile', function ($b) use($marriage_method) {
                $b->where('marriage_method', $marriage_method);
            });
        })->when($request->search['length_from'] != null || $request->search['length_to'] != null, function($q) use($length_from,$length_to) {
            $q->whereBetween('length',[$length_from,$length_to]);
        })->when($request->search['weight_from'] != null || $request->search['weight_to'] != null, function($q) use($weight_from,$weight_to) {
            $q->whereBetween('weight',[$weight_from,$weight_to]);
        })->when($request->search['age_from'] != null || $request->search['age_to'] != null, function($q) use($minDate,$maxDate) {
            $q->whereBetween('birthday', [$minDate,$maxDate]);
        });
        return $users->get();
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
