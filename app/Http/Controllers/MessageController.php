<?php

namespace App\Http\Controllers;

use DateTime;
use App;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageNotification;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Str;


class MessageController extends Controller
{
    /**
     * Display a listing of messages.
     *
     * @return Response
     */
    public function index() {

        $conversation = Conversation::where('name', Input::get('conversation'))->first();
        $messages = Message::where('conversation_id', $conversation->id)->orderBy('created_at', 'desc')->take(20)->get();

        $result  = array();
        foreach ($messages as $message)
            array_push($result, $message);

        krsort($result);
        $response['messages'] = $result;

        $response['userId'] = Auth::user()->id;

        return View::make('partials/chat',$response)->render();
    }

    /**
     * Store a newly created message in storage.
     *
     * @return Response
     */
    public function store() {

        $pusher = App::make('pusher');


        $rules     = array('body' => 'required');
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return Response::json([
                'success' => false,
                'result' => $validator->messages()
            ]);
        }
        
        $id = Input::get('conversation');
        $conversation = Conversation::where('name', $id)->first();

        $params = array(
            'conversation_id' => $conversation->id,
            'body'               => Input::get('body'),
            'type'              =>  'text',
            'user_id'           => Input::get('user_id'),
        );


        $conversation->save();

        $authorMsg = App\Models\User::where('id', Input::get('user_id'))->first();
        $conversationId = $conversation->id;

        $message = Message::create($params);
        $message->type = 'text';

        // Create Message Notifications
        $messages_notifications = array();




        foreach($conversation->users()->get() as $user) {
            array_push($messages_notifications, new MessageNotification(array('user_id' => $user->id, 'conversation_id' => $conversation->id, 'read' => false)));
            $fullname = $authorMsg->firstname.' '.$authorMsg->lastname;
            $img = $user->image_path;
            $pusher->trigger('channel_'.$user->id, 'message',
                array(
                    'room'        => Input::get('conversation'),
                    'message'  => array( 'body' => Str::words($message->body, 5), 
                                        'user_id' => Input::get('user_id'),
                                        'fullname' => $fullname, 
                                        'img' => $img,
                                        'conserId' => $conversationId)
                ));
        }

        $message->messages_notifications()->saveMany($messages_notifications);

        // Publish Data To Redis
       /* $data = array(
            'room'        => Input::get('conversation'),
            'message'  => array( 'body' => Str::words($message->body, 5), 'user_id' => Input::get('user_id'))
        );

        Event::fire(new ChatMessagesEvent(json_encode($data)));


*/




        $msg = '<div class="item item-visible in"><div class="image">'.'<img src="'.$authorMsg->image_path.'" alt="'.$authorMsg->firstname.' '.$authorMsg->lastname.'">'.
        '</div><div class="text"><div class="heading">'.
                '<a href="#">'.$authorMsg->firstname.' '.$authorMsg->lastname .'</a>' .
                '<span class="date">'.$message->created_at.'</span></div>'.
         $message->body.
       ' </div></div>';

        return response($msg, 200);

        //return Redirect::route('chat.index', array('conversation', $conversation->name));
    }
    
  
}
