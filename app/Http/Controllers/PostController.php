<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App;
use App\Http\Requests;
use DateTime;
use Auth;
use App\Repositories\FileEntryRepository;
use Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class PostController extends Controller
{

    protected $fileentryRepository;
    protected $userRepository;

    public function __construct(FileEntryRepository $fileentryRepository, UserRepository $userRepository)
    {
        $this->fileentryRepository = $fileentryRepository;
        $this->userRepository = $userRepository;
    }

    public function index($id = null, $cat = null){
        $response = array();

        if ($id == 'category')
        {

            $postNotifications = Auth::user()->postNotification($cat);
            $response['onePost'] = false;
            $response['posts'] = $postNotifications;
            $response['number'] = $postNotifications->count();
            $response['title'] = App\Models\Subject::where('id', $cat)->first()->subjects;

            return View::make('front.post',$response)->render();

        }
        elseif(!is_null($id)){
            $post = App\Models\Post::where('id', $id)->first();
            $user_id = Auth::user()->id;

            if($user_id == $post->user_id)
                return redirect()->route('myrequest');


            $postNotif = $post->posts_notifications()->where('user_id', $user_id)->first();

            if(!is_null($postNotif))
            {
                $postNotif->read = 1;
                $postNotif->save();
            }


            $response['description'] = $post->description;
            $title = 'Request - '.$response['description'];
            $response['title'] = $title;
            $response['content'] = $post->content;
            $response['users'] = $post->users->fullname();
            $response['user_id'] = $post->users->id;
            $response['date'] = $post->created_at;
            $response['category'] = $post->cat->subjects;
            $response['onePost'] = true;
            $response['type'] = $post->type;
            
            if($response['type'] != 'text')
            {
                $response['filename'] = $post->file->filename;
                $response['original_filename'] = $post->file->original_filename;
            }

            return View::make('front.post',$response)->render();
        }
        else
        {
            $query = DB::table('post_notification')
                ->join('post', 'post_notification.post_id', '=', 'post.id')
                ->select('post_notification.*')
                ->where('post.solved',0) 
                 ->where('post_notification.user_id', Auth::user()->id)
                ->orderBy('post_notification.created_at', 'desc')
                ->groupBy('cat_id')
                ->get()
                ;

                $i=0;
            foreach ($query as $item)
            {
                $count = DB::table('post_notification')
                    ->join('post', 'post_notification.post_id', '=', 'post.id')
                    ->select('post_notification.*')
                    ->where('post.solved',0)
                    ->where('post_notification.user_id', Auth::user()->id)
                    ->where('post_notification.cat_id', $item->cat_id)
                    ->orderBy('post_notification.created_at', 'desc')
                    ->count();

                $cat = App\Models\Subject::where('id', $item->cat_id)->first();
                $response['category'][$i] = $cat->subjects;
                $response['cat_id'][$i] = $cat->id;
                $response['count_category'][$i] = $count;
                $i++;
            }


            $postNotifications = Auth::user()->postNotification();

            foreach($postNotifications as $postNotification)
            {
                $postNotification->read = 1;
                $postNotification->save();
            }

            $response['onePost'] = false;
            $response['posts'] = $postNotifications;
            $response['number'] = $postNotifications->count();
            $response['title'] = 'Requests';
 

            return View::make('front.post',$response)->render();
        }
    }
    
    public function Handlefile(){
     
        $pusher = App::make('pusher');

        $rules = array(
            'file' => 'required',
            'type'  =>  'required',
            'cat'  =>  'required',
            'user_id'  =>  'required',
            'title'  =>  'required'
        );

        $validator = Validator::make(Request::only('file', 'cat', 'title', 'user_id', 'type'), $rules);

        if($validator->fails()) {
            return Response::json([
                'success' => false,
                'result' => $validator->messages()
            ]);
        }

        $type = Request::input('type');

        $file = Request::file('file');
        
        if(strpos($type, 'image') !== false)
            {
            $type = 'Picture';
            $fileentry = $this->fileentryRepository->store($file, Request::input('user_id'), 'Pictures');
        }
        else
        {
            $type = 'File';
            $fileentry = $this->fileentryRepository->store($file, Request::input('user_id'), 'Files');
        }
            
            

        $params = array(

            'content'  => ' ',
            'user_id'  => Request::input('user_id'),
            'description' =>  Request::input('title'),
            'type' =>  $type,
            'file_id' => $fileentry->id,
            'category' =>  Request::input('cat'),
        );

        $post =   App\Models\Post::create($params);



        $userSimple = App\Models\Subject::where('id', Input::get('cat'))->first()->userSimple()->inRandomOrder()->take(50)->get();

        $userCoach = App\Models\Subject::where('id', Input::get('cat'))->first()->userCoach()->get();


        $post_notificationSimple = $this->spreadPost($userSimple, $pusher, $post);

        $post_notificationCoach = $this->spreadPost($userCoach, $pusher, $post);

        $post_notifications= array_merge($post_notificationCoach, $post_notificationSimple);

        $post->posts_notifications()->saveMany($post_notifications);


        return  view('partials.success');
     }

    public function HandleText(){

        $pusher = App::make('pusher');

        $rules = array(
            'text' => 'required',
            'user'  =>  'required',
            'cat'  =>  'required',
            'title'  =>  'required'
        );

        $validator = Validator::make(Input::only('text', 'cat', 'title', 'user'), $rules);

        if($validator->fails()) {
            return Response::json([
                'success' => false,
                'result' => $validator->messages()
            ]);
        }

        $params = array(

            'content'  => Input::get('text'),
            'user_id'  => Auth::user()->id,
            'description' =>  Input::get('title'),
            'type' =>  'text',
            'category' =>  Input::get('cat'),
        );
        
        $post =   App\Models\Post::create($params);



        $userSimple = App\Models\Subject::where('id', Input::get('cat'))->first()->userSimple()->inRandomOrder()->take(50)->get();

        $userCoach = App\Models\Subject::where('id', Input::get('cat'))->first()->userCoach()->get();

        $post_notificationSimple = $this->spreadPost($userSimple, $pusher, $post);

        $post_notificationCoach = $this->spreadPost($userCoach, $pusher, $post);

        $post_notifications= array_merge($post_notificationCoach, $post_notificationSimple);

        $post->posts_notifications()->saveMany($post_notifications);



        return  view('partials.success');
    }
    
    public function sendModal(){
        return  view('partials.PostModal');
    }
    
    public function myrequest(){

        $posts = App\Models\Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);

        return view('front.request', ['posts' => $posts, 'number' => $posts->count()]);
    }

    private function spreadPost($users, $pusher, $post ){

        $post_notifications = array();

        foreach ($users as $user){
            if($user->id != Auth::user()->id)
            {
                array_push($post_notifications, new App\Models\PostNotification(array('user_id' =>  $user->id, 'cat_id' =>  Input::get('cat'),  'read' => false)));

                $pusher->trigger('channel_'.$user->id, 'post',
                    array(
                        'message'  => array(
                            'description' => $post->description,
                            'category' => $post->cat->subjects,
                            'date' => $post->created_at,
                            'author' => $post->users->fullname(),
                             'id' => $post->id)
                    ));

                $this->userRepository->sendWebPush($user->id, 'Post : '.$post->description.' - '.$post->cat->subjects ,'/request/'.$post->id);
            }
        }

        return $post_notifications;

    }

    public function deletePost($id)
    {
         $post = App\Models\Post::where('id', $id)->first();
         $post->delete();
        
        return redirect('myrequest');
    }

    public function edit(){
        $rules = array(
            'text' => 'required',
            'post_id'  =>  'required',
        );

        $validator = Validator::make(Request::only('text', 'post_id'), $rules);

        if($validator->fails()) {
            return Response::json([
                'success' => false,
                'result' => $validator->messages()
            ]);
        }

    $post = App\Models\Post::where('id', Request::input('post_id'))->first();
    $post->content = Request::input('text');
    $post->save();
    
        return $post->content;
    }

}
