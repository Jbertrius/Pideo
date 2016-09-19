<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

/**
 * App\Fileentry
 *
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Fileentry extends Model
{
    protected $table = 'fileentries';

    public function user(){
        
        return $this->belongsTo('App\Models\User');
    
    }

    public function getPath($id){
        $entry = Fileentry::where('id', '=', $id)->firstOrFail();
        $file = Storage::url($entry->filename);
        
        return $file;
    }
}
