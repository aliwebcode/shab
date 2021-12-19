<?php

namespace App\Http\Controllers\Api;

use App\Activation;
use App\Block;
use App\Http\Controllers\Controller;
use App\Mail;
use App\Notifications\ImageSendNotification;
use App\Events\ImageSendEvent;
use App\Profile;
use App\RequestReceiver;
use App\SentImage;
use App\User;
use App\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function myProfile($id)
    {
        $user = User::find($id);
        if ($user->hasVerifiedEmail())
            $user->is_verify = 1;
        else
            $user->is_verify = 0;
        if ($user->profile)
            $complete = 1;
        else
            $complete = 0;
        $activate = Activation::where('user_id', $user->id)->latest()->first();
        $activated = null;
        if ($activate && $activate->approved == 1) {
            $activated = 1;
        } else if ($activate && $activate->approved == -1) {
            $activated = -1;
        } else if ($activate && $activate->approved == 0) {
            $activated = 0;
        } else if (!$activate) {
            $activated = "n";
        }
        return response()->json(['user' => $user, 'complete' => $complete, 'activated' => $activated]);
    }

    public function getProfile($id, $myId)
    {
        $user = User::find($id);
        if (!$user)
            return 0;
        if($user->profileStatus == 0) {
            return -1;
        }
        $b = Block::where([
            ['user_id',$id],
            ['blocked',$myId]
        ])->orWhere([
            ['user_id',$myId],
            ['blocked',$id]
        ])->first();
        if($b) {
            return -1;
        }
        return response()->json($user);
    }

    public function getProfileDetails(Request $request)
    {
        $b = Block::where([
            ['user_id',$request->user_id],
            ['blocked',$request->my_id]
        ])->orWhere([
            ['user_id',$request->my_id],
            ['blocked',$request->user_id]
        ])->first();
        if($b) {
            return -1;
        }
        $profile = Profile::where('user_id', $request->user_id)->first();
        if (!$profile)
            return 0;
        return response()->json($profile);
    }

    public function get_user($id)
    {
        $user = User::find($id);
        $data = [];
        if (!$user) {
            $data[] = ["user" => 0];
        }
        $data[] = ["user" => $user];
        if ($user->hasVerifiedEmail())
            $data[] = ["is_verify" => 1];
        else
            $data[] = ["is_verify" => 0];

        return response()->json($data);
    }

    public function changeProfileStatus(Request $request)
    {
        $user = User::find($request->id);
        if ($user->profileStatus == 1)
            $user->profileStatus = 0;
        else
            $user->profileStatus = 1;
        $user->save();
        return response()->json(1);
    }

    public function complete_profile_action(Request $request)
    {

        $profile = new Profile();
        $profile->skin = $request->skin;
        $profile->religion = $request->religion;
        $profile->smoking = $request->smoking;
        $profile->financial = $request->financial;
        $profile->financial_plus = $request->financial_plus;
        $profile->body = $request->body;
        $profile->marriage_method = $request->marriage_method;
//        if(auth()->user()->gender == 'female')
//            $profile->future_living = $request->skin;
        $profile->user_id = $request->user_id;
        $profile->save();
        return response()->json(1);
    }

    public function activate(Request $request)
    {
        $row = new Activation();
        if (isset($request->image)) {
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $imageName = time() . 'thumbnails.' . $imageExt;
            $request->file('image')->storeAs('public/images/documents', $imageName);
            $row->image = $imageName;
        }
        $row->image_type = $request->image_type;
        $row->user_id = $request->user_id;
        $row->save();
        return response()->json(1);
    }

    public function changePassword(Request $request)
    {
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(1);
    }

    public function changeImage(Request $request)
    {
        $user = User::find($request->user_id);
        if($user->image) {
            if(File::exists('storage/images/'.$user->image)) {
                File::delete('storage/images/'.$user->image);
            }
        }
        if (isset($request->image)) {
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $imageName = time() . 'thumbnails.' . $imageExt;
            $request->file('image')->storeAs('public/images', $imageName);
            $user->image = $imageName;
            $user->avatar = null;
        } else if (isset($request->avatar)) {
            $user->image = null;
            $user->avatar = $request->avatar;
        }
        $user->save();
        return response()->json(1);
    }

    public function sendImage(Request $request) {
        $from = User::find($request->from_id);
        if($from->image == "") {
            return -1;
        }
        $user = User::where('user_code',$request->user_code)->first();
        if($user) {
            File::copy('storage/images/' . $from->image, 'storage/images/sent/' . $from->image);
            $row = new SentImage();
            $row->from_id = $request->from_id;
            $row->to_id = $user->id;
            $row->image = $from->image;
            $row->save();
//            broadcast(new ImageSendEvent($row));
            $user->notify(new ImageSendNotification($row));
            return $user;
        } else {
            return 0;
        }
    }

    public function editProfile(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nationality = $request->nationality;
        $user->country = $request->country;
        $user->birthday = $request->birthday;
        $user->length = $request->length;
        $user->weight = $request->weight;
        $user->ethnicity = $request->ethnicity;
        $user->study = $request->study;
        $user->employee = $request->employee;
        $user->phone = $request->phone;
        if (isset($request->ethnicity_parent)) {
            $user->ethnicity_parent = $request->ethnicity_parent;
        }
        $user->save();
        return 1;
    }

    public function editInterests(Request $request)
    {
        $user = User::find($request->user_id);
        $user->userDescription = $request->userDescription;
        $user->partnerDescription = $request->partnerDescription;
        $user->save();
        return 1;
    }

    public function send_request(Request $request) {
        $r = UserRequest::where([
            ['from_id', $request->from_id],
            ['to_id', $request->to_id]
        ])->first();
        if($r) {
            return 0;
        }
        $row = new UserRequest();
        $row->from_id = $request->from_id;
        $row->to_id = $request->to_id;
        $row->save();
        return 1;
    }

    public function get_pending_requests($id)
    {
        $requests = UserRequest::where([
            ['to_id', $id],
            ['status', '0']
        ])->get();
        $data = [];
        foreach ($requests as $request) {
            $user = User::find($request->from_id);
            $data[] = ["user" => $user, "request" => $request];
        }
        return response()->json($data);
    }

    public function send_reject_reason(Request $request)
    {
        $req = UserRequest::find($request->id);
        $req->status = 'R';
        $req->reject_reason = $request->reject;
        $req->save();
        return 1;
    }

    public function send_first_accept(Request $request)
    {
        $dates = $request->row['dates'];
        $i = -1;
        foreach ($dates as $date) {
            $i ++;
            $row = new RequestReceiver();
            $row->request_id = $request->row['req_id'];
            $row->rec_date = $date['value'];
            $row->rec_hour = $request->row['times'][$i]['hour'];
            $row->rec_minute = $request->row['times'][$i]['minute'];
            $row->rec_host = $request->row['host'];
            $row->save();
        }
        $req = UserRequest::find($request->row['req_id']);
        $id = $req->to_id;
        $req->status = 1;
        $req->save();
        $requests = UserRequest::where([
            ['to_id', $id],
            ['status', '0']
        ])->get();
        $data = [];
        foreach ($requests as $request) {
            $user = User::find($request->from_id);
            $data[] = ["user" => $user, "request" => $request];
        }
        return response()->json($data);

    }

    public function get_user_gender($id) {
        $user = User::find($id);
        return response()->json($user->gender);
    }

    public function get_active_requests($id) {
        $requests = UserRequest::where([
            ['to_id',$id],
            ['status',1]
        ])->get();
        $data = [];
        foreach ($requests as $request) {
            $user = User::find($request->from_id);
            $requestDate = RequestReceiver::where([
                ['request_id',$request->id],
                ['selected',1]
            ])->first();
            $req_date = 0;
            $req_hour = 0;
            $req_minute = 0;
            if($requestDate) {
                $req_date = $requestDate->rec_date;
                $req_hour = $requestDate->rec_hour;
                $req_minute = $requestDate->rec_minute;
            }
            $data[] = ["user" => $user, "request" => $request, "requestDate" => $req_date, "requestHour" => $req_hour, "requestMinute" => $req_minute];
        }
        return response()->json($data);
    }

    public function cancel_request(Request $request) {
        $row = UserRequest::find($request->id);
        $row->status = 'C';
        $row->save();
        return 1;
    }

    public function get_blocked($id) {
        $rows = Block::where('user_id',$id)->get();
        $data = [];
        foreach ($rows as $row) {
            $user = User::find($row->blocked);
            $data[] = ["user" => $user, "block" => $row];
        }
        return response()->json($data);
    }

    public function cancel_block(Request $request) {
        $row = Block::find($request->id);
        $row->delete();
        return 1;
    }

    public function get_male_requests($id) {
        $requests = UserRequest::where('from_id',$id)->orderBy('id','desc')->get();
        $data = [];
        foreach ($requests as $request) {
            $user = User::find($request->to_id);
            $requestDate = RequestReceiver::where([
                ['request_id',$request->id],
                ['selected',1]
            ])->first();
            $req_date = 0;
            $req_hour = 0;
            $req_minute = 0;
            if($requestDate) {
                $req_date = $requestDate->rec_date;
                $req_hour = $requestDate->rec_hour;
                $req_minute = $requestDate->rec_minute;
            }
            $data[] = ["user" => $user, "request" => $request, "requestDate" => $req_date, "requestHour" => $req_hour, "requestMinute" => $req_minute];
        }
        return response()->json($data);
    }

    public function get_dates($id) {
        $dates = RequestReceiver::where('request_id',$id)->get();
        return response()->json($dates);
    }

    public function select_date(Request $request) {
        $row = RequestReceiver::find($request->id);
        $row->selected = 1;
        $row->save();
        return 1;
    }

    public function get_notifications($id) {
        $user = User::find($id);
//        $data = [];
//        $im = SentImage::where('to_id',$id)->get();
//        foreach ($im as $i) {
//            $user = User::find($i->from_id);
//            $data[] = ["user" => $user, "not" => $i];
//        }
//        $req = UserRequest::where('to_id',$id)->get();
//        $data = $req->merge($im)
        return $user->notifications;
    }

    public function get_notifications_mark(Request $request) {
        $im = SentImage::where([
            ['to_id',$request->user_id],
            ['seen',0]
        ])->get();
        foreach ($im as $i) {
            $i->seen = 1;
            $i->save();
        }
        return 1;
    }

    public function get_mail() {
        $mails = Mail::all();
        return response()->json($mails);
    }

}
