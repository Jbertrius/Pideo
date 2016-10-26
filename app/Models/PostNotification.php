<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostNotification extends Model
{
    protected $table = 'post_notification';

    protected $fillable = array('user_id', 'created_at', 'updated_at', 'post_id', 'cat_id', 'read');

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

    public function cat()
    {
        return $this->belongsTo('App\Models\Subject', 'cat_id');
    }

}
