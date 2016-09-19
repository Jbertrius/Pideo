<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MessageNotification
 *
 * @property-read \App\Models\Conversation $conversation
 * @mixin \Eloquent
 */
class MessageNotification extends Model
{
    protected $table = 'messages_notifications';
    
    protected $fillable = array('user_id', 'created_at', 'updated_at', 'message_id', 'conversation_id', 'read');

    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation', 'conversation_id');
    }
}
