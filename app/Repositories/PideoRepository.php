<?php


namespace App\Repositories;

use App\Models\Fileentry;
use Storage;
use Request;
use Illuminate\Http\Response;
use App\Models\Pideo;
use App\Models\Tag;
use File;

class PideoRepository extends BaseRepository
{

    protected $model;
    protected $tag;

    public function __construct(Pideo $model, Tag $tag)
    {
        $this->model = $model;
        $this->tag = $tag;
    }

    public function store($param) {
        
        $pideo = new Pideo();
        $pideo->user_id = $param['userId'];
        $pideo->subject_id = $param['cat'];
        $pideo->title = $param['title'];
        $pideo->filename = $param['filename'];



        $pideo->save();

        if (array_key_exists('tags', $param) && $param['tags'] != '') {
            $tags = explode(',', $param['tags']);

        foreach ($tags as $tag) {
            $tag_ref = $this->tag->whereTag($tag)->first();
            if (is_null($tag_ref)) {
                $tag_ref = new $this->tag();
                $tag_ref->tag = $tag;
                $pideo->tags()->save($tag_ref);
            } else {
                $pideo->tags()->attach($tag_ref->id);
            }
        }
        }
        

        
        return $pideo;
    }

    public static function streamFile( $contentType, $path ) {
        $fullsize = filesize($path);
        $size = $fullsize;
        $stream = fopen($path, "r");
        $response_code = 200;
        $headers = array("Content-type" => $contentType);

        // Check for request for part of the stream
        $range = Request::header('Range');
        if($range != null) {
            $eqPos = strpos($range, "=");
            $toPos = strpos($range, "-");
            $unit = substr($range, 0, $eqPos);
            $start = intval(substr($range, $eqPos+1, $toPos));
            $success = fseek($stream, $start);
            if($success == 0) {
                $size = $fullsize - $start;
                $response_code = 206;
                $headers["Accept-Ranges"] = $unit;
                $headers["Content-Range"] = $unit . " " . $start . "-" . ($fullsize-1) . "/" . $fullsize;
            }
        }

        $headers["Content-Length"] = $size;

        return Response::stream(function () use ($stream) {
            fpassthru($stream);
        }, $response_code, $headers);
    }

    public function delete($id){
        $pideo = $this->model->with('filename',$id);
        $pideo->tags()->detach();
        $pideo->delete();
    }


}