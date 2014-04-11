<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home'
));

// Route::controller('/test', TestController::stTest());

Route::get('/account/test', array(
    'as' => 'test',
    'uses' => 'TestController@test'
));

//Route::get('/account/create', array(
//    'as' => 'account-create',
//    'uses' => 'AccountController@getCreate'
//));
//
//Route::get('/account/test', array(
//    'as' => 'account-test',
//    'uses' => 'TestController@index'
//));




// unathenticated group
Route::group(array('before' => 'guest'), function() {
    // Opening cross-over request
    // CSRF protection /Cross-site request forgery/
    Route::group(array('before' => 'csrf'), function() {
        // Create account (GET)
        Route::post('/account/create', array(
            'as' => 'account-create-post',
            'uses' => 'AccountController@postCreate'
        ));
    });

    // Create account (GET)
    Route::get('/account/create', array(
        'as' => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));
});



/*
Route::get('/', function()
{
	return View::make('home.index');
});

Route::get('about', function()
{
        $data=array('gorivo'=>'gaz');
	return View::make('home.about', $data);
        // return View::make('home.about')->with('gorivo', $gorivo);
});
/**/