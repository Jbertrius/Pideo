<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Home
Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => ''
]);
Route::get('back/result', 'MakepideoController@back');
Route::get('language/{lang}', 'HomeController@language')->where('lang', '[A-Za-z_-]+');
Route::get('auth/confirm/{token}', 'Auth\AuthController@getConfirm');
Route::get('login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as' => 'login']);
Route::get('auth/resend', 'Auth\AuthController@getResend');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('register', [
    'uses' => 'Auth\AuthController@getRegister',
    'as' => 'register']);
Route::post('register', 'Auth\AuthController@postRegister');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('confirm ', function( ){
    return view('auth.confirm') ;
})->name('confirm');




Route::group( ['middleware' => 'auth' ], function()
{


    Route::get('home', 'HomeController@home');



    // User
    Route::get('user/sort/{role}', 'UserController@indexSort');
    Route::get('user/xml/{type1?}/{param1?}/{type2?}/{param2?}/{type3?}/{param3?}', 'UserController@xml');

    Route::get('user/roles', 'UserController@getRoles');
    Route::post('user/roles', 'UserController@postRoles');

    Route::post('user/profilePic', 'UserController@editPic');

    Route::put('userseen/{user}', 'UserController@updateSeen');

    Route::resource('user', 'UserController');


    // Authentication routes...

    Route::get('auth/logout', 'Auth\AuthController@getLogout');


    Route::get('messages/', array(
        'before' => 'auth',
        'as'     => 'chat.index',
        'uses'   => 'ChatController@index'
    ));

    Route::get('/chat/', array(
        'before' => 'auth',
        'as'     => 'messages.index',
        'uses'   => 'MessageController@index'
    ));

    Route::post('/messages/', array(
        'before' => 'auth',
        'as'     => 'messages.store',
        'uses'   => 'MessageController@store'
    ));


    Route::get('users/{user_id}/conversations', array(
        'before' => 'auth',
        'as'	 => 'conversations_users.index',
        'uses'	 => 'ConversationUserController@index'
    ));

    Route::post('/conversations/', array(
        'before' => 'auth',
        'as' 	 => 'conversations.store',
        'uses'   => 'ConversationController@store'
    ));

    Route::get('/conversations/', array(
        'before' => 'auth',
        'as' 	 => 'conversations.index',
        'uses'   => 'ConversationController@index'
    ));

    Route::get('/newmsg/', array(
        'before' => 'auth',
        'as' 	 => 'conversations.modal',
        'uses'   => 'ConversationController@modal'
    ));

    Route::post('fileentry/addPic/{user?}', array(
        'before' => 'auth',
        'as' 	 => 'fileentry.addpic',
        'uses'   => 'FileEntryController@addPic'
    ));
    
    Route::post('fileentry/addFile/{user?}', array(
        'before' => 'auth',
        'as' 	 => 'fileentry.addfile',
        'uses'   => 'FileEntryController@addFile'
    ));

    Route::get('files/{filename}', [
        'as' => 'getentry', 'uses' => 'FileEntryController@get']);

    Route::get('pideos/{filename}', ['uses' => 'MakepideoController@getPideos']);

    Route::get('makepideo', 'MakepideoController@index');

    Route::post('delete/{filename}', 'MakepideoController@delete');

    Route::post('createpideo', 'MakepideoController@make');
        
    Route::get('images/{filename}/{crop}', function ($filename, $crop)
    {
        $img =  \Intervention\Image\Facades\Image::make(storage_path() . '/app/Pictures/' . $filename);
        if($crop == 1)
            $img->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
        elseif ($crop == 2)
            $img->fit(200,200, function ($constraint) {
                $constraint->upsize();
            }, 'top-left');
        elseif ($crop == 3)
        {$img->fit(32,32, function ($constraint) {
                $constraint->upsize();
            }, 'top-left');
            $img->rectangle(0, 0, 32, 32, function ($draw) {

                $draw->border(2, '#FFF');
            });
            }


            return $img->response();
    });



    Route::get('convert', 'MakepideoController@getImages');

	// Admin
	Route::get('admin', [
        'uses' => 'AdminController@admin',
        'as' => 'admin',
        'middleware' => 'admin'
    ]);

	Route::get('medias', [
        'uses' => 'AdminController@filemanager',
        'as' => 'medias',
        'middleware' => 'redac'
    ]);


    Route::post('/post/file', [
        'uses' => 'PostController@Handlefile'
    ]);

    Route::post('/post/text', [
        'uses' => 'PostController@HandleText'
    ]);
    
    Route::get('post', [
        'uses' => 'PostController@sendModal',
        'as'  =>  'postmodal'
    ]);

    Route::get('post/delete/{id}', [
        'uses' => 'PostController@deletePost'
    ]);






    Route::get('front/home', [
    'uses' => 'HomeController@home',
    'as' => 'home']);

    Route::get('map', [
        'uses' => 'HomeController@map',
        'as' => 'map']);

    Route::get('profile', [
    'uses' => 'HomeController@profile',
    'as' => 'profile']);

    Route::get('edit', [
    'uses' => 'HomeController@edit',
    'as' => 'edit']);

    Route::get('request/{id?}/{cat?}', [
        'uses' => 'PostController@index',
        'as' => 'request']);

    Route::get('myrequest', [
        'uses' => 'PostController@myrequest',
        'as' => 'myrequest']);
    
    
    
    
    
    
    
    });

