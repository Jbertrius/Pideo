<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Post extends Model
{
    use DatePresenter;
    
    protected $table = 'post';
    protected $fillable = array('content', 'created_at', 'type', 'user_id', 'category', 'description', 'file_id');

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function cat(){
        return $this->belongsTo('App\Models\Subject', 'category', 'id');
    }

    public function posts_notifications() {
        return $this->hasMany('App\Models\PostNotification', 'post_id', 'id');
    }

}


