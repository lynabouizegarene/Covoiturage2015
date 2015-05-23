<?php namespace App\Http\Controllers;

use App\Model\Covoiturage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class WelcomeController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        //$this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function recents(){
        $recents = Covoiturage::with('villeDepart','villeArrivee','conducteur')
            ->select('id','date_depart','prix','vehicule','conducteur_id','ville_arrivee_id','ville_depart_id')
            ->where('date_depart', '>', date("Y-m-d H:i:s"))
            ->orderBy('date_depart')
            ->take(5)
            ->get();
        return view('covoiturage.covoituragesRecents')->with(compact('recents'));
    }

    public  function show(){
        return view('welcome');
    }

    public function ccm(){
        return view('commentcamarche');
    }
}
