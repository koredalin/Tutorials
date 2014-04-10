<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

       public function home() {
           Mail::send('emails.auth.test', array('name'=>'Ivan'), function($message) {
               $message->to('koredalin@gmail.com', 'Hristo Hristov')->subject('Test email.');
               
           });
           
           
           
//           $user=User::find(1)->username;
//           echo $user;
           // echo '<pre>', print_r($user), '</pre>';
           return View::make('home');
       }
    
    
    
    
    
}
    
    
    
    /*
    protected $layout = 'templates.master';
    
	public function showWelcome()
	{
		return View::make('hello');
	}

}
     * 
     * 
/**/