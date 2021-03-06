<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subject
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @mixin \Eloquent
 */
class Subject extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subjects';

    /**
     * Many to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\belongToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function userSimple()
    {
        return $this->belongsToMany('App\Models\User')->where('role_id','<>',3);
    }

    public function userCoach()
    {
        return $this->belongsToMany('App\Models\User')->where('role_id',3);
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }
    
    public static function getAll(){
        return Subject::orderBy('subjects')->get();
    }

 
    
}
