<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Fileentry;
use App\Models\Message;
use App\Events\ChatMessagesEvent;
use Event;
use Illuminate\Support\Str;
use App\Models\MessageNotification;
use DateTime;
use App\Repositories\FileEntryRepository;
use Request;
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
    
    public function __construct(FileEntryRepository $fileentryRepository)
    {
        $this->fileentryRepository = $fileentryRepository;
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
            'created_at'      => new DateTime
        );

        $message = Message::create($params);
  

        // Create Message Notifications
        $messages_notifications = array();

        foreach($conversation->users()->get() as $user) {
            array_push($messages_notifications, new MessageNotification(array('user_id' => $user->id, 'conversation_id' => $conversation->id, 'read' => false)));
        }

        $message->messages_notifications()->saveMany($messages_notifications);

        // Publish Data To Redis
        $data = array(
            'room'        => $request->input('conversation'),
            'message'  => array( 'body' => 'New picture',
                'user_id' => $request->input('user_id'),
                'pic' => $fileentry->id)
        );

        Event::fire(new ChatMessagesEvent(json_encode($data)));

        return Response::json([
            'success' => true,
            'result' => $user
        ]);

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
            'created_at'      => new DateTime
        );

        $message = Message::create($params);


        // Create Message Notifications
        $messages_notifications = array();

        foreach($conversation->users()->get() as $user) {
            array_push($messages_notifications, new MessageNotification(array('user_id' => $user->id, 'conversation_id' => $conversation->id, 'read' => false)));
        }

        $message->messages_notifications()->saveMany($messages_notifications);

        // Publish Data To Redis
        $data = array(
            'room'        => $request->input('conversation'),
            'message'  => array( 'body' => 'New File',
                'user_id' => $request->input('user_id'),
                'pic' => $fileentry->id)
        );

        Event::fire(new ChatMessagesEvent(json_encode($data)));

        return Response::json([
            'success' => true,
            'result' => $user
        ]);

    }

    public function get($filename){

        $entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);
        $path = storage_path().'/app/Files/'.$entry->filename;

       // return (new Response($file, 200))
         //   ->header('Content-Type', $entry->mime);

        $headers = array(
            'Content-Type' => $entry->mime,
        );

        return response()->download($path, $entry->original_filename, $headers);
 
    }
    
    

}
