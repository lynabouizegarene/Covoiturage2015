<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

    /**
     * Create a new controller instance.
     *
     * @return \App\Http\Controllers\HomeController
     */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = Auth::user();
        $file = $user->id.'.jpg';
        if (Storage::exists($file))
        {
            $pathPhoto='../storage/app/'.$file;
        }elseif($user->genre=='Homme'){
            $pathPhoto='../storage/app/Homme.jpg';
        }else{
            $pathPhoto='../storage/app/Femme.jpg';
        }

		return view('home',compact('pathPhoto'));
	}

}
