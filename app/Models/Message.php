<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

/**
 * App\Models\Message
 *
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Conversation $conversation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MessageNotification[] $messages_notifications
 * @mixin \Eloquent
 */
class Message extends Model
{

    use DatePresenter;
    
    protected $table = 'messages';
    protected $fillable = array('body', 'created_at','type', 'user_id', 'conversation_id');

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation', 'conversation_id');
    }

    public function messages_notifications() {
        return $this->hasMany('App\Models\MessageNotification', 'message_id', 'id');
    }
}
