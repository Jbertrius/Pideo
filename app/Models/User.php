<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use DB;
use Illuminate\Pagination\Paginator;
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
        return $this->belongsToMany('App\Models\Conversation', 'conversations_users')->orderBy('update_at','DESC') ;
    }

    public function files(){
        return $this->hasMany('App\Models\Fileentry');
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public  function fullname()
    {
       return $this->firstname.' '.$this->lastname;
    }

    public function postNotification($cat = null){

        $notifications = array();

        if($cat == null)
                $posts =  Post::where('solved', 0)->get();
        else
            $posts = Post::where('solved', 0)->where('category', $cat)->get();

        foreach ($posts as $post)
        {
            $post_notifications = $post->posts_notifications()->where('user_id', $this->id)->orderBy('created_at', 'desc')->get();

            foreach ($post_notifications as $post_notification )
                array_push($notifications, $post_notification);
        }


        /*$notifications=  DB::table('post_notification')
            ->join('post', 'post_notification.post_id', '=', 'post.id')
            ->select('post_notification.*')
            ->where('post.solved',0)
            ->where('post_notification.user_id', $this->id)
            ->orderBy('post_notification.created_at', 'desc')
            ->paginate(6);*/

        $perPage = 9;

        $pagination = new Paginator($notifications, $perPage);

        return $pagination;
    }


}
