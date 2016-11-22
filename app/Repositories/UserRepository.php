<?php

namespace App\Repositories;

use App\Models\User, App\Models\Role, App\Models\Subject;
 
use   Berkayk\OneSignal\OneSignalFacade;
use Illuminate\Support\Facades\URL;
use File;
use Storage;


class UserRepository extends BaseRepository
{
    /**
     * The Role instance.
     *
     * @var App\Models\Role
     */

    protected $role;
    protected $subject;

    /**
     * Create a new UserRepository instance.
     *
     * @param User|App\Models\User $user
     * @param Role|App\Models\Role $role
     */
    public function __construct(User $user, Role $role, Subject $subject)
    {
        $this->model = $user;
        $this->role = $role;
        $this->subject = $subject;
    }

    /**
     * Create a user.
     *
     * @param  array  $inputs
     * @param  int    $confirmation_code
     * @return App\Models\User
     */
    public function store($inputs, $confirmation_code = null)
    {
        $user = new $this->model;
        $user->password = bcrypt($inputs['password']);
        $user->image_path = asset('img/icons/user.png');
        $subjects = [$inputs['sub1'], $inputs['sub2']];



        if($confirmation_code) {
            $user->confirmation_code = $confirmation_code;
            $user->confirmed = true;
        } else {
            $user->confirmed = true;
        }
        $this->save($user, $inputs);

        foreach ($subjects as $subject){
            if(is_numeric($subject))
            {
                $subject_ref = $this->subject->where('id', $subject)->first();
                $user->subjects()->attach($subject_ref->id);
            }
            else
            {
                $subject_ref = $this->subject->where('subjects', $subject)->first();
                if (is_null($subject_ref)) {
                $subject_ref = new $this->subject();
                $subject_ref->subjects = $subject;
                }
                $user->subjects()->save($subject_ref);
            }
        }

        return $user;
    }

    /**
     * Save the User.
     *
     * @param User|App\Models\User $user
     * @param Array|array $inputs
     */

    private function save(User $user, Array $inputs)
    {
        if(isset($inputs['seen']))
        {
            $user->seen = $inputs['seen'] == 'true';
        } else {
            
            if(isset($inputs['email']))
            $user->email = $inputs['email'];
            
            $user->lastname = strtoupper($inputs['lastname']);

            $user->firstname = ucfirst($inputs['firstname']);
            $user->latitude = $inputs['lat'];
            $user->longitude = $inputs['lng'];
            $user->city = $inputs['city'];
            $user->number = $inputs['number'];
            $user->lang = $inputs['lang'];
            

            if (isset($inputs['role'])) {
                $user->role_id = $inputs['role'];
            } else {
                $role_user = $this->role->where('slug', 'user')->first();
                $user->role_id = $role_user->id;
            }
        }

        $user->save();
    }
    
    /**
     * Update a user.
     *
     * @param  array  $inputs
     * @param  App\Models\User $user

     */
    public function update($user, $inputs)
    {
        $user->confirmed = isset($inputs['confirmed']);

        $this->save($user, $inputs);
        $subjects_id = [];
        if (array_key_exists('sub1', $inputs) && $inputs['sub1'] != '' && array_key_exists('sub2', $inputs) && $inputs['sub2'] != '' ) {
            $subjects = [$inputs['sub1'], $inputs['sub2']];

            foreach ($subjects as $subject){
                if(is_numeric($subject))
                {
                    $subject_ref = $this->subject->where('id', $subject)->first();
                }
                else
                {
                    $subject_ref = $this->subject->where('subjects', $subject)->first();
                    if (is_null($subject_ref)) {
                    $subject_ref = new $this->subject();
                    $subject_ref->subjects = $subject;
                    $subject_ref->save();
                    }
                }
                array_push($subjects_id, $subject_ref->id);
            }
            $user->subjects()->sync($subjects_id);
        }


    }
    
    public function updateAttribute($variable, $value){

       User::where('id', \Auth::user()->id)->update([''.$variable => $value]);;

        return $value;
    }

    public function updateCity($variable, $value, $lat, $lng){

        User::where('id', \Auth::user()->id)->update([''.$variable => $value, 'latitude' => $lat, 'longitude' => $lng]);;

        return $value;
    }

    public function updateSubject($old, $new_id){
        
        $sub = Subject::where('subjects', $old)->first()->id;
        $subs = array();

        
        foreach (\Auth::user()->subjects as $subject)
        {
            if($sub == $subject->id)
                array_push($subs, $new_id);
            else
                array_push($subs, $subject->id); 

        }

        \Auth::user()->subjects()->sync($subs);
        
        return Subject::where('id',$new_id)->first()->subjects;
        
    }



    /**
     * Get users collection paginate.
     *
     * @param  int  $n
     * @param  string  $role
     * @return Illuminate\Support\Collection
     */
    public function index($n, $role)
    {
        if($role != 'total')
        {
            return $this->model
                ->with('role')
                ->whereHas('role', function($q) use($role) {
                    $q->whereSlug($role);
                })
                ->oldest('seen')
                ->latest()
                ->paginate($n);
        }
        return $this->model
            ->with('role')
            ->oldest('seen')
            ->latest()
            ->paginate($n);
    }

    /**
     * Count the users.
     *
     * @param  string  $role
     * @return int
     */
    public function counts()
    {
        $counts = [
            'admin' => $this->count('admin'),
            'redac' => $this->count('redac'),
            'user' => $this->count('user')
        ];
        $counts['total'] = array_sum($counts);
        return $counts;
    }

    /**
     * Count the users.
     *
     * @param  string  $role
     * @return int
     */
    public function count($role = null)
    {
        if($role)
        {
            return $this->model
                ->whereHas('role', function($q) use($role) {
                    $q->whereSlug($role);
                })->count();
        }
        return $this->model->count();
    }

    /**
     * Get statut of authenticated user.
     *
     * @return string
     */
    public function getStatut()
    {
        return session('statut');
    }
    /**
     * Valid user.
     *
     * @param  bool  $valid
     * @param  int   $id
     * @return void
     */
    public function valid($valid, $id)
    {
        $user = $this->getById($id);
        $user->valid = $valid == 'true';
        $user->save();
    }
    /**
     * Destroy a user.
     *
     * @param  App\Models\User $user
     * @return void
     */
    public function destroyUser(User $user)
    {
        $user->comments()->delete();

        $user->delete();
    }
    /**
     * Confirm a user.
     *
     * @param  string  $confirmation_code
     * @return App\Models\User
     */
    public function confirm($confirmation_code)
    {
        $user = $this->model->whereConfirmationCode($confirmation_code)->firstOrFail();
        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();
    }
    
    public function getUSer($lang = 'lang',$param1 = 'all',$sub= 'sub',$param2 = 'all',$type = 'all',$param3 = null){
        // User::where('firstname', 'EZIN')->get();

        if($param2 == 'all')
            return ($param1 == 'all') ? User::all() : User::where($lang, $param1)->get();
        else
            return ($param1 == 'all') ? Subject::find($param2)->users : Subject::find($param2)->users->where($lang , $param1);
    }
    
    public function changePic(User $user, $file){

        $extension = $file->getClientOriginalExtension();
        
        $path = Storage::put('Pictures/'.$file->getFilename().'.'.$extension, File::get($file) );

        $user->image_path = '/images/'.$file->getFilename().'.'.$extension.'/2';
        $user->save();
        
        return $user;
    }

    public function getAllExcept($id)
    {
        return $this->model->where('id', '<>', $id)->get();
    }

    public function sendWebPush($id, $msg, $url){

        $user = User::where('id', $id)->first();

        foreach ($user->webpushid as $userId)
        {
            OneSignalFacade::sendNotificationToUser($msg, $userId->webpushid, $url);
        }

    }
    
    

}