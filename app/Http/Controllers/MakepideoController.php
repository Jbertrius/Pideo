<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use App\Models\Conversation;
use App\Repositories\PideoRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\Pideo;
use  Dawson\Youtube\YoutubeFacade;
use Anam\PhantomMagick\Converter;
use View;
use Linkthrow\Ffmpeg\Classes\FFMPEG;
use Image;
use App\Models\MessageNotification;
use File;
use App\Models\User;
use App\Models\Message;
use Storage;
use App\Http\Requests;
use App\Repositories\FileEntryRepository;

class MakepideoController extends Controller
{

    protected $fileentryRepository;
    protected $pideoRepository;
    protected $userRepository;

    public function __construct(FileEntryRepository $fileentryRepository, PideoRepository $pideoRepository, UserRepository $userRepository )
    {
        $this->fileentryRepository = $fileentryRepository;
        $this->pideoRepository = $pideoRepository;
        $this->userRepository = $userRepository;
    }

     public function index(){
         $isConnected = \Illuminate\Support\Facades\Auth::check();
        return View::make('front/pideo', ['isConnected' => $isConnected ]);
     }

    public function back($result){
        return View::make('layouts.back', $result);
    }

    public function make(Request $request){

        $getID3 = new \getID3;

        $sectionCpt = count($request->file('files'));

        /* Logo recuperation */
        $logo = storage_path().'/app/public/logo.png';


        $params['title'] = $request->input('title');
        $params['cat'] = $request->input('category');
        $params['school'] =  $request->input('school');

        if(!is_null(\Auth::user()))
        {
            $userId = \Auth::user()->id;
            $params['userId'] = $userId;
            $description = "Piideo created by ".\Auth::user()->fullname();
        }
        else
        {
            $userId = 'guest';
            $params['username'] = $request->input('username');
            $description = "Piideo created by ".$params['username'];
        }


        $pictures = $request->file('files');
        $audios = $this->arrangeAudio($request);


        $imgEntry = []; $audioEntry = [];

        $id = str_random(30);

        $videopath = storage_path().'/app/Pideos/'.$userId.'_'.$id;
        $videoList = array('#');

        for($i = 0; $i< $sectionCpt; $i++){

            $img =  $pictures[$i];
            $imageSession = $this->fileentryRepository->store($img, null, 'Pideos');
            $imgEntry['img'.$i] = $imageSession->filename;

            $audio = $audios[$i+1];
            $audioSession = $this->fileentryRepository->store($audio, null, 'Pideos');
            $audioEntry['audio'.$i] = $audioSession->filename;

            $imgPath = $videopath.'/'.$userId.'_'.$id.'_'.$imgEntry['img'.$i];
            $audioPath = storage_path().'/app/Pideos/'.$audioEntry['audio'.$i];

            $file = $getID3->analyze($audioPath);
            $time = $file['playtime_seconds'];


            Storage::makeDirectory('Pideos/'.$userId.'_'.$id);

            $watermask = Image::make(storage_path().'/app/Pideos/'.$imgEntry['img'.$i]);

            $width = $watermask->width();
            $height = $watermask->height();

            $calcuHeight = ( 1280 / $width ) * $height;


            if($width > $height && $calcuHeight < 720)
                $watermask->resize(1280, null, function ($constraint) {
                    $constraint->aspectRatio();

                });
            else
                $watermask->resize(null, 720, function ($constraint) {
                    $constraint->aspectRatio();

                });

            $watermask->insert($logo);
            $img = null;

            $img = Image::canvas(1280, 720)->insert($watermask, 'center')->save($imgPath);



            if($i == 0)
                copy( storage_path().'/app/Pideos/'.$imgEntry['img'.$i] , storage_path().'/app/Pictures/'.$userId.'_'.$id.'.jpg');



            FFMPEG::convert()->input($imgPath)
                ->input($audioPath)
                ->output($videopath.'/section'.$i.'.mp4')
               ->go('-loop 1 -y','-vcodec libx264 -acodec aac -t '.$time)
               // ->go('-loop 1','-c:v libx264 -t 30 -pix_fmt yuv420p')
            ;

            $str = "file 'section".$i.".mp4'";
            array_push($videoList, $str);

            $this->fileentryRepository->delete('Pideos', $imageSession->id);
            $this->fileentryRepository->delete('Pideos', $audioSession->id);

        }

        File::put($videopath.'/'.$userId.'_'.$id.'.txt',implode(PHP_EOL, $videoList));

        FFMPEG::convert()->input($videopath.'/'.$userId.'_'.$id.'.txt')
                        ->output(storage_path().'/app/Pideos/'.$userId.'_'.$id.'.mp4')
                        ->go('-f concat','-c copy');

        $params['path'] = storage_path().'/app/Pideos/'.$userId.'_'.$id.'.mp4';
        $params['filename'] = $userId.'_'.$id.'.mp4';



        $videoID = $this->uploadYoutube($params['path'], $params['title'], $description);

        $params['youtubeID'] = $videoID;

         $pideo = $this->pideoRepository->store($params);

        try{
        Storage::deleteDirectory('Pideos/'.$userId.'_'.$id);
        }catch (\Exception $e){

        }

        return $videoID;





    }



    public function delete($filename){

        Storage::delete('Pideos/'.$filename);
        $this->pideoRepository->delete($filename);

        $filename =  str_replace('.mp4', '.jpg', $filename);
        Storage::delete('Pictures/'.$filename);
    }

    public function getPideos($filename){

        $videosDir = storage_path().'/app/Pideos/';
        if (file_exists($filePath = $videosDir."/".$filename)) {
            $stream = new \App\Http\VideoStream($filePath);
            return response()->stream(function() use ($stream) {
                $stream->start();
            });
        }
        return response("File doesn't exists", 404);

    }
    
    private function arrangeAudio($request){
        $audios = [];
        $index = $request->input('audio');
        $blobs = $request->file('audio');
        $cpt = count($request->input('audio'));

        for($i = 0; $i < $cpt; $i++)
            $audios[$index[$i]['id']] = $blobs[$i]['blob'];

        return $audios;
    }
    
    public function send(Request $request){
        
        $rules = array(
            'id' => 'required',
            'pideo'  =>  'required',
            'conversation'  =>  'required',

        );

        $validator = \Validator::make($request->all() , $rules);

        if($validator->fails()) {
            return \Response::json([
                'success' => false,
                'result' => $validator->messages()
            ]);
        }

        $id = $request->input('conversation');
        $conversation = Conversation::where('name', $id)->first();

        $pideo_name = $request->input('pideo');
        $pideo = Pideo::where('filename', $pideo_name)->first();

        $params = array(
            'conversation_id' => $conversation->id,
            'body'               =>   $pideo->id,
            'type'              =>  'pideo',
            'user_id'           => \Auth::user()->id,
        );
        
        $conversation->touch();

        $authorMsg = \Auth::user();
        $message = Message::create($params);


        // Create Message Notifications
        $messages_notifications = array();

        foreach($conversation->users()->get() as $user) {
            array_push($messages_notifications, new MessageNotification(array('user_id' => $user->id, 'conversation_id' => $conversation->id, 'read' => false)));
            $this->sendNotif($user->id, $id, 'Pideo :'.$pideo->title, $authorMsg, $conversation->id  );


        }

        $message->messages_notifications()->saveMany($messages_notifications);


         return   $conversation->name;
        
        
    }

    private function uploadYoutube($pathToVideo, $title, $description = '' ){

        $video = YoutubeFacade::upload($pathToVideo, [
            'title'       => $title,
            'description' => $description,
            'tags'        => ['piideo', 'tuto'],
            'category_id' => 10
        ], 'unlisted');

        return $video->getVideoId();
    }

    private function sendNotif($idest, $room, $message, $user, $conver){
        $pusher = \App::make('pusher');

        $pusher->trigger('channel_'.$idest, 'message',
            array(
                'room'        => $room,
                'message'   => array( 'body' => $message,
                    'user_id' => $user->id,
                    'fullname' => $user->firstname.' '.$user->lastname,
                    'img' => $user->image_path,
                    'conserId' => $conver),
            ));

        $this->userRepository->sendWebPush($user->id, $user->firstname.' '.$user->lastname .' send you a Pideo'  , '/messages/?conversation='.$room);

    }


}




