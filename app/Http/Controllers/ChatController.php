<?php

namespace App\Http\Controllers;

use App\Repositories\ConversationRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ChatController extends Controller
{
    /**
     * @var \\Repositories\ConversationRepository
     */
    private $conversationRepository;

    /**
     * @var \\Repositories\UserRepository
     */
    private $userRepository;

    public function __construct(ConversationRepository $conversationRepository, UserRepository $userRepository)
    {
        $this->conversationRepository = $conversationRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display the chat index.
     *
     * @return Response
     */
    public function index() {

        $viewData = array();

        if(Input::has('conversation')) {
            $viewData['current_conversation'] = $this->conversationRepository->getByName(Input::get('conversation'));
        } else {
            $viewData['current_conversation'] = Auth::user()->conversations()->first();
        }

        if(!is_null($viewData['current_conversation']))
        {
            if($viewData['current_conversation']) {
                Session::set('current_conversation', $viewData['current_conversation']->name);

                foreach($viewData['current_conversation']->messagesNotifications()->get() as $notification) {
                    $notification->read = true;
                    $notification->save();
                }
            }

            $users = $this->userRepository->getAllExcept(Auth::user()->id);

            foreach($users as $key => $user) {
                $viewData['recipients'][$user->id] = $user->firstname;
            }

            $viewData['conversations'] = Auth::user()->conversations()->get();

            return View::make('front/messages', $viewData);            
        }
        else
        {
            $msg = "You don't have any messages yet, Select a user on the map to send your first message.";
            $data = '<div class="message-box message-box-info animated fadeIn open" id="message-box-info">'.
   ' <div class="mb-container">'.
    '    <div class="mb-middle">'.
     '       <div class="mb-title"><span class="fa fa-check"></span> Information</div>'.
      '      <div class="mb-content">'.
       '         <p>'.$msg.'</p>'.
        '    </div>'.
         '   <div class="mb-footer">'.
          '      <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>'.
           ' </div>'.
       ' </div>'.
    '</div>'.
'</div>';

 
        
            return View::make('front/map', ['data' => $data]);
        }
            

    }
}
