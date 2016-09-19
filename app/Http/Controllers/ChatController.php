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
}
