<?php

namespace App\Http\Controllers;

use App\Models\Webpushid;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class WebPushController extends Controller
{
     public function addWebPushId(Request $request){
         
         $user_id = $request->get('UserId');


         $params = array(
             'user_id'  => Auth::user()->id,
             'webpushid' => $user_id,
             
         );

         if(Webpushid::where('webpushid', $user_id)->count() == 0)
           $webPushId = Webpushid::create($params);
         
         return '';
     }
    
}
