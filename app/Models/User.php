<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * App\Models\User
 *
 * @property-read \App\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * Check media all access
     *
     * @return bool
     */
    public function accessMediasAll()
    {
        return $this->role->slug == 'admin';
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject');
    }


    /**
     * Check media access one folder
     *
     * @return bool
     */
    public function accessMediasFolder()
    {
        return $this->role->slug != 'user';
    }

    
    
    public function is(User $user)
    {
        return $this->getKey() == $user->getKey();
    }

    public function conversations() {
        return $this->belongsToMany('App\Models\Conversation', 'conversations_users');
    }

    public function file(){
        return $this->hasMany('App\Models\Fileentry');
    }
}
