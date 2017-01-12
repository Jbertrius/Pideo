<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\ChangeLocale;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  /*  public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $isConnected = \Illuminate\Support\Facades\Auth::check();
        return View::make('front/pideo', ['isConnected' => $isConnected ]);


    }

    public function home()
    {
        return view('front.home');
    }

    public function map(){
        return view('front.map');
    }

    /**
     * Change language.
     *
     * @param  App\Jobs\ChangeLocaleCommand $changeLocale
     * @param  String $lang
     * @return Response
     */
    public function language( $lang, ChangeLocale $changeLocale)
    {
        $lang = in_array($lang, config('app.languages')) ? $lang : config('app.fallback_locale');
        $changeLocale->lang = $lang;
        $this->dispatch($changeLocale);
        return redirect()->back();
    }

    public function profile($profile){
        if (strpos($profile, '.') !== false) {
            try{
            $name = explode('.', $profile);
            $user_id = User::where('firstname',$name[0])->where('lastname', $name[1])->first()->id;

            return view('front.profile', ['user_id' => $user_id]);
            }catch (\Exception $e){
                \App::abort(404);
            }
        }
        else
            \App::abort(404);

    }

    public function edit(){
        return view('front.edit');
    }

    public function message(){
        return view('front.messages');
    }
    
}
