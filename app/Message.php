<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    protected $appends = ['time'];

    public function fromContact() {
        return $this->hasOne(User::class, 'id', 'from_id');
    }

    public function getTimeAttribute() {
        return $this->created_at->diffForHumans();
    }
}
