<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use DateTime;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class PostController extends Controller
{

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


            $postNotif = $post->posts_notifications->where('user_id', Auth::user()->id)->first();
            $postNotif->read = 1;
            $postNotif->save();

            $response['description'] = $post->description;
            $title = 'Request - '.$response['description'];
            $response['title'] = $title;
            $response['content'] = $post->content;
            $response['users'] = $post->users->fullname();
            $response['user_id'] = $post->users->id;
            $response['date'] = $post->created_at;
            $response['category'] = $post->cat->subjects;
            $response['onePost'] = true; 

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
            $response['onePost'] = false;
            $response['posts'] = $postNotifications;
            $response['number'] = $postNotifications->count();
            $response['title'] = 'Requests';
 

            return View::make('front.post',$response)->render();
        }
    }
    
    public function Handlefile(){


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
            'created_at' => new DateTime,
            'content'  => Input::get('text'),
            'user_id'  => Auth::user()->id,
            'description' =>  Input::get('title'),
            'type' =>  'text',
            'category' =>  Input::get('cat'),
        );
        
        $post =   App\Models\Post::create($params);

        $post_notifications = array();

        $users = App\Models\Subject::where('id', Input::get('cat'))->first()->users()->get();


        foreach ($users as $user){
            if($user->id != Auth::user()->id)
            {
                array_push($post_notifications, new App\Models\PostNotification(array('user_id' =>  $user->id, 'cat_id' =>  Input::get('cat'),  'read' => false)));

                $pusher->trigger('channel_'.$user->id, 'post',
                    array(
                        'message'  => array()
                    ));
            }

        }

        $post->posts_notifications()->saveMany($post_notifications);



        return  view('partials.success');
    }
    
    public function sendModal(){
        return  view('partials.PostModal');
    }
    
    public function myrequest(){

        $posts = App\Models\Post::where('user_id', Auth::user()->id)->paginate(6);

        return view('front.request', ['posts' => $posts, 'number' => $posts->count()]);
    }
}
