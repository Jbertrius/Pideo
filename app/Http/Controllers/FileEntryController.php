<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Models\Conversation;
use App\Models\Fileentry;
use App\Models\Message;
use App\Events\ChatMessagesEvent;
use Event;
use Illuminate\Support\Str;
use App\Models\MessageNotification;
use DateTime;
use App\Repositories\FileEntryRepository;
use App;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Response;
use App\Models\User;
use App\Http\Requests\FileCreateRequest;
use App\Http\Requests\FileRequest;

class FileEntryController extends Controller
{
    protected $fileentryRepository;
    protected $userRepository;
    
    public function __construct(FileEntryRepository $fileentryRepository, UserRepository $userRepository)
    {
        $this->fileentryRepository = $fileentryRepository;
        $this->userRepository = $userRepository;
    }

    
    public function index()
    {
        $entries = Fileentry::all();
        return view('fileentries.index', compact('entries'));
    }

    public function addPic(FileCreateRequest $request, $userId) {

        $file = $request->file('pic');
        $fileentry = $this->fileentryRepository->store($file, $userId->id, 'Pictures');

        $id = $request->input('conversation');
        $conversation = Conversation::where('name', $id)->first();

        $params = array(
            'conversation_id' => $conversation->id,
            'body'               => $fileentry->id,
            'type'              =>  'pic',
            'user_id'           => $request->input('user_id'),

        );


        $conversation->save();
        
        $authorMsg = App\Models\User::where('id', $request->input('user_id'))->first();
        $message = Message::create($params);
  

        // Create Message Notifications
        $messages_notifications = array();

        foreach($conversation->users()->get() as $user) {
            array_push($messages_notifications, new MessageNotification(array('user_id' => $user->id, 'conversation_id' => $conversation->id, 'read' => false)));
            $this->sendNotif($user->id, $id, $fileentry->original_filename, $authorMsg, $conversation->id  );
        }

        $message->messages_notifications()->saveMany($messages_notifications);

        // Publish Data To Redis
        $data = array(
            'room'        => $request->input('conversation'),
            'message'  => array( 'body' => 'New picture',
                'user_id' => $request->input('user_id'),
                'pic' => $fileentry->id)
        );


        $pic = '<div class="item item-visible in "> <div class="image"> <img src="'.$authorMsg->image_path.'" alt="'.$authorMsg->firstname.'"> </div>'.
                       ' <div class="text boxpic"> <div class="gallery" id="links">'.
                        '<a href="images/'.$fileentry->filename.'/0 " title=" '.$fileentry->original_filename.' " class="gallery-item apic" data-gallery="">'.
                            '<div class="image imagebox"> <img src="images/'.$fileentry->filename.'/1 " alt=" '.$fileentry->original_filename.'" class="img"> </div> </a> </div> </div> </div>';

          return response($pic, 200);

    }

    public function addFile(FileRequest $request, $userId) {

        $file = $request->file('file');
        $fileentry = $this->fileentryRepository->store($file, $userId->id, 'Files');

        $id = $request->input('conversation');
        $conversation = Conversation::where('name', $id)->first();

        $params = array(
            'conversation_id' => $conversation->id,
            'body'               => $fileentry->id,
            'type'              =>  'file',
            'user_id'           => $request->input('user_id'),

        );

        $conversation->save();

        $authorMsg = App\Models\User::where('id', $request->input('user_id'))->first();
        $message = Message::create($params);


        // Create Message Notifications
        $messages_notifications = array();

        foreach($conversation->users()->get() as $user) {
            array_push($messages_notifications, new MessageNotification(array('user_id' => $user->id, 'conversation_id' => $conversation->id, 'read' => false)));
            $this->sendNotif($user->id, $id, $fileentry->original_filename, $authorMsg, $conversation->id  );

        }

        $message->messages_notifications()->saveMany($messages_notifications);


        $file = '<div class="item item-visible in"> <div class="image"> <img src="'.$authorMsg->image_path.'" alt="'.$authorMsg->firstname.'">'.
        '</div> <div class="text" style="color: white"> <a href="/files/'.$fileentry->filename.'" style="color: white">'.$fileentry->original_filename.'</a> </div></div>';
        return response($file, 200);

    }

    public function get($filename){

        $entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
       // $file = Storage::disk('local')->get($entry->filename);
        $path = storage_path().'/app/Files/'.$entry->filename;

       // return (new Response($file, 200))
         //   ->header('Content-Type', $entry->mime);

        $headers = array(
            'Content-Type' => $entry->mime,
        );

        return response()->download($path, $entry->original_filename, $headers);
 
    }

    private function sendNotif($idest, $room, $message, $user, $conver){
        $pusher = App::make('pusher');

        $pusher->trigger('channel_'.$idest, 'message',
            array(
                'room'        => $room,
                'message'   => array( 'body' => $message,
                    'user_id' => $user->id,
                    'fullname' => $user->firstname.' '.$user->lastname,
                    'img' => $user->image_path,
                    'conserId' => $conver),
            ));

        $this->userRepository->sendWebPush($user->id, $user->firstname.' '.$user->lastname.' send you a File' , '/messages/?conversation='.$room );
    }
    
    

}
