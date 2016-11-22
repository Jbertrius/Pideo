<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webpushid extends Model
{
    protected $fillable = ['user_id', 'webpushid'];

    protected $table = 'webpushid';

    public function user()
    {
        return $this->belongsTo('App\Models\Webpushid');
    }
}
