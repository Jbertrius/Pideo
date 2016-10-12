<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
        if($request->session()->get('statut') == 'user')
            return view('front.home');
        else
            return view('front.accueil');

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

    public function profile(){
        return view('front.profile');
    }

    public function edit(){
        return view('front.edit');
    }

    public function message(){
        return view('front.messages');
    }
    
}
