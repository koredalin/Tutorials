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