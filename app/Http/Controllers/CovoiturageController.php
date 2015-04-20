<?php namespace App\Http\Controllers;


use App\Http\Requests\StoreCovoiturageRequest;
use App\Model\Covoiturage;
use App\Model\User;
use App\Model\Ville;
use Illuminate\Support\Facades\Auth;

class CovoiturageController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('covoiturage.publier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreCovoiturageRequest $request)
    {
        $data = $request->all();

        $geoloc_d = $this->getLonLat($data['geoloc_d']);
        $geoloc_a = $this->getLonLat($data['geoloc_a']);

        $ville_d = Ville::firstOrCreate([
            'nom' => $data['ville_d'],
            'wilaya' => $data['wilaya_d'],
            'longitude' => $geoloc_d[0],
            'latitude' => $geoloc_d[1],
        ]);
        $ville_a  = Ville::firstOrCreate([
            'nom' => $data['ville_a'],
            'wilaya' => $data['wilaya_a'],
            'longitude' => $geoloc_a[0],
            'latitude' => $geoloc_a[1],
        ]);

        Covoiturage::create([
            'ville_depart_id' => $ville_d->getAttribute('id'),
            'ville_arrivee_id' => $ville_a->getAttribute('id'),
            'conducteur_id' => Auth::id(),
            'nombre_places' => $data['nombre_places'],
            'date_depart' => $data['date_depart'],
            'vehicule' => $data['vehicule'],
            'prix' => $data['prix'],
            'details' => $data['details'],
            'bagage' => $data['bagage'],
            'flexibilite_horaire' => $data['flexibilite_horaire']
        ]);
        return redirect(route('home'))->with('message', 'Votre annonce a bien été publié');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return 'covoiturage '.$id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

    }

}