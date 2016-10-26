<?php

namespace App\Http\Controllers;

use App\Events\ChatConversationsEventHandler;
use Event;
use App;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageNotification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\ConversationRepository;
use DateTime;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ConversationController extends Controller
{
    private $conversationRepository;
    private $userRepository;

    public function __construct(ConversationRepository $conversationRepository, UserRepository $userRepository)
    {
        $this->conversationRepository = $conversationRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of conversations.
     *
     * @return Response
     */
    public function index()
    {
        $viewData = array();

        $users = $this->userRepository->getAllExcept(Auth::user()->id);

        foreach($users as $key => $user) {
            $viewData['recipients'][$user->id] = $user->firstname;
        }

        $viewData['current_conversation'] = $this->conversationRepository->getByName(Input::get('conversation'));
        $viewData['conversations'] = Auth::user()->conversations()->take(8)->get();

        return View::make('partials/conversations', $viewData);
    }

    /**
     * Store a newly created conversation in storage.
     *
     * @return Response
     */
    public function store()
    {

        $pusher = App::make('pusher');

        $rules = array(
            'id' => 'required',
            'body'  =>  'required'
        );

        $validator = Validator::make(Input::only('id', 'body'), $rules);

        if($validator->fails()) {
            return Response::json([
                'success' => false,
                'result' => $validator->messages()
            ]);
        }

        // Create Conversation
        $params = array(
            'created_at' => new DateTime,
            'update_at' => new DateTime, 
            'name'          => str_random(30),
            'author_id'  => Auth::user()->id
        );

        $conversation = Conversation::create($params);

        $conversation->users()->attach(array(Input::get('id')));
        $conversation->users()->attach(array(Auth::user()->id));



        // Create Message
        $params = array(
            'conversation_id' => $conversation->id,
            'body'               => Input::get('body'),
            'type'              => 'text',
            'user_id'           => Auth::user()->id,
            'created_at'      => new DateTime
        );

        $message = Message::create($params);

        // Create Message Notifications
        $messages_notifications = array();

        if(!is_array(Input::get('id')))
            $users_id = array(Input::get('id'));
        else
            $users_id = Input::get('id');

        $authorMsg = App\Models\User::where('id', Input::get('id'))->first();

        foreach($users_id as $user_id) {
            array_push($messages_notifications, new MessageNotification(array('user_id' => $user_id, 'read' => false, 'conversation_id' => $conversation->id)));
            $fullname = $authorMsg->firstname.' '.$authorMsg->lastname;
            $img = App\Models\User::where('id', $user_id)->first()->image_path;

            $pusher->trigger('channel_'.$user_id, 'message',
                array(
                    'room'        => Input::get('conversation'),
                    'message'  => array( 'body' => Str::words($message->body, 5),
                        'user_id' => Input::get('user_id'),
                        'fullname' => $fullname,
                        'img' => $img,
                        'conserId' => $conversation->id)
                ));


            // Publish Data To Redis
           /* $data = array(
                'room'    => $user_id,
                'message' => array('conversation_id' => $conversation->id)
            );
*/
            //Event::fire(new ChatConversationsEvent(json_encode($data)));


        }

        $message->messages_notifications()->saveMany($messages_notifications);

        return Redirect::route('chat.index', array('conversation', $conversation->name));
    }

    public function modal(){
        $user = User::where('id',Input::get('user'))->first();
         
        $recipient['id'] = $user->id;
        $recipient['firstname'] = $user->firstname;
        $recipient['lastname'] = $user->lastname;

        $user_conversations = Auth::user()->conversations;

        $exist = false;
        $current_conversation = null;
        foreach ($user_conversations as $conversation){
             foreach ($conversation->users as $single_user){
                 if($single_user->id == $user->id )
                     $exist = true;
             }
            $current_conversation = $conversation;

            if($exist == true)
            return  'redirect/messages/?conversation='.$current_conversation->name;
        }

        
        return  View::make('partials/new_message_modal', $recipient);
    }
}
