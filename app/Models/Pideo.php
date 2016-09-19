<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pideo extends Model
{

    protected $table = 'pideos';


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject','subject_id');
    }


    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
