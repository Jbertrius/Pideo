<?php 

namespace App\Repositories;

use App\Models\Fileentry;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\User;
use File;

class FileEntryRepository extends BaseRepository
{
    protected $model;

    public function __construct(Fileentry $model)
    {
        $this->model = $model;
    }

    public function store($file, $user_id, $type) {

        $extensions = array('image/jpeg' => 'jpg',
            'audio/wav' => 'wav'
        );


        $extension = $file->getClientOriginalExtension();


        if($extension == "")
           $extension = $extensions[$file->getClientMimeType()];

        $path = Storage::put($type.'/'.$file->getFilename().'.'.$extension, File::get($file) );
        $entry = new Fileentry();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;

        if(!is_null($user_id))
            $entry->user_id = $user_id;
        
        $entry->save();
        
        return $entry;
    }

    public function delete($type, $id){
        $file = Fileentry::where('id',$id)->first();
        Storage::delete($type.'/'.$file->filename);
        $file->delete();
    }

 
    
}
