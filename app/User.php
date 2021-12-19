<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'nationality', 'country', 'status', 'birthday',
        'length', 'weight', 'ethnicity', 'ethnicity_parent', 'study', 'employee', 'image', 'avatar',
        'phone', 'userDescription', 'partnerDescription',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.'.$this->id;
    }

    public function getContacts() {
        $messages = Message::where('to_id',$this->id)->orWhere('from_id',$this->id)->get();
        $contacts = [];
        foreach ($messages as $message) {
            if ($message->from_id != $this->id) {
                $user = User::find($message->from_id);
                if(!in_array($user,$contacts))
                    $contacts[] = $user;
            } else {
                $user = User::find($message->to_id);
                if(!in_array($user,$contacts))
                    $contacts[] = $user;
            }
        }
        return $contacts;
    }

}
