<?php

namespace App\Http\Controllers;

use View;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use App\Repositories\UserRepository;
use XMLWriter;

use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userRepository;

    protected $nbrPerPage = 4;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = $this->userRepository->getPaginate($this->nbrPerPage);
        $links = $users->render();

        return view('index', compact('users', 'links'));
    }

    public function xml($type1 = 'lang', $param1 = 'all', $type2 = 'sub', $param2 = 'all', $type3 = 'all', $param3 = 'all'){

        if($param2 == 'all')
            $users = ($param1 == 'all') ? $this->userRepository->getUSer() : $this->userRepository->getUSer($type1,$param1);
        else 
            $users = $this->userRepository->getUSer($type1,$param1,$type2,$param2);

    

        $xml = new XMLWriter();

        $xml->openMemory();
        $xml->startDocument();
        $xml->startElement('markers');
        foreach($users as $user) {
            $xml->startElement('marker');
            $xml->writeAttribute('id', $user->id);
            $xml->writeAttribute('firstname', $user->firstname);
            $xml->writeAttribute('lastname', $user->lastname);
            $xml->writeAttribute('email', $user->email);
            $xml->writeAttribute('city', $user->city);
            $xml->writeAttribute('lat', $user->latitude);
            $xml->writeAttribute('lng', $user->longitude);
            $xml->writeAttribute('language', $user->lang);
                $subjects = $user->subjects()->get();
                $i = 1;
            foreach($subjects as $subject) {
                $xml->writeAttribute('sub'.$i, $subject->subjects);
                $i++;
            }
            $xml->endElement();
        }
        $xml->endElement();

        $xml->endDocument();

        $content = $xml->outputMemory();
        $xml = null;

        return response($content)->header('Content-Type', 'text/xml');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = $this->userRepository->store($request->all());

        return redirect('user')->withOk("L'utilisateur " . $user->name . " a été créé.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        return view('show',  compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($variable, Request $request)
    {
        $value = $request->get('value');
        $attribute = $this->userRepository->updateAttribute($variable, $value);

        return $attribute;
    }


    public function editCity($variable, Request $request)
    {
        $value = $request->get('value');
        $lat = $request->get('lat');
        $lng = $request->get('lng');

        $attribute = $this->userRepository->updateCity($variable, $value, $lat, $lng);

        return $attribute;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $old = $request->input('old');
        $new = $request->input('new');
        $confirm = $request->input('confirm');


        if( $old != '' && $new != '' && $confirm != ''){
            $oldpwd = $id->password;
            if($oldpwd != bcrypt($old))
                return redirect('edit')
                    ->with('error', 'Mot de passe incorrect');
            else
                if($new!= $confirm)
                    return  redirect('edit')
                        ->with('error', 'Mot de passe non identique');
                else
                    $id->password = bcrypt($new);
        }

        $this->userRepository->update($id, $request->all());
        
        
        return redirect('edit')->withOk("L'utilisateur " . $request->input('name') . " a été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           
        $this->userRepository->destroy($id);

        return redirect()->back();
    }

    public function editPic(Request $request){

        $id = $request->input('user_id');

        $user = User::where('id',$id)->first();

        $user = $this->userRepository->changePic($user, $request->file('pic'));
        
        return response($user->image_path,200) ;
    }
    
    public function getUser(){
        return  view('partials.userList');
    }

    public function getSubject(Request $request)
    {
        $cur = $request->get('subject');
        $cur = Subject::where('subjects',$cur)->first();
        
        return View::make('partials.subjectList', ['current' => $cur->subjects, 'id' => $cur->id]);
    }

    public function updateSubject(Request $request)
    {
        $curent = $request->get('current');
        $update = $request->get('update'); 
        
        return $this->userRepository->updateSubject($curent,$update);
 
    }

}
