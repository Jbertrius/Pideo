<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    protected $table    = 'conversations';
    protected $fillable = array('author_id', 'name', 'updated_at');

    public $timestamps = true;

    public function users() {
        return $this->belongsToMany('App\Models\User', 'conversations_users', 'conversation_id', 'user_id')->where('user_id', '<>', Auth::user()->id);
    }
    
    public function messages() {
        return $this->hasMany('App\Models\Message', 'conversation_id', 'id');
    }

    public function messagesNotifications() {
        return $this->hasMany('App\Models\MessageNotification')->where('read', 0)->where('user_id', Auth::user()->id);
    }
}
