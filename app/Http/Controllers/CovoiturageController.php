<?php namespace App\Http\Controllers;


use App\Model\Covoiturage;
use App\Model\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CovoiturageController extends Controller
{

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
    public function store(Request $request)
    {
        $this->validate($request,[
            'autocomplete_d' => 'required|max:255',
            'ville_d' => 'required|max:255',
            'wilaya_d' => 'required|max:255',
            'geoloc_d' => 'required|max:255',
            'autocomplete_a' => 'required|max:255',
            'ville_a' => 'required|max:255',
            'wilaya_a' => 'required|max:255',
            'geoloc_a' => 'required|max:255',
            'date_depart' => 'required|after:'.date('y-m-d h:i'),
            'prix' => 'required|numeric',
            'nombre_places' => 'required|numeric',
            'vehicule' => 'required',
            'bagage' => 'required|in:petit,moyen,grand',
            'flexibilite_horaire' => 'required|in:Pile à l\'heure,+/- 15 minutes,+/- 30 minutes',
        ]);
        $data = $request->all();
        $geoloc_d = $data['geoloc_d'];
        $geoloc_d = str_replace(["(", ")"], "", $geoloc_d);
        $geoloc_d = explode(",", $geoloc_d);
        $geoloc_d[0] = (Double)($geoloc_d[0]);
        $geoloc_d[1] = (Double)($geoloc_d[1]);

        $geoloc_a = $data['geoloc_a'];
        $geoloc_a = str_replace(["(", ")"], "", $geoloc_a);
        $geoloc_a = explode(",", $geoloc_a);
        $geoloc_a[0] = (Double)($geoloc_a[0]);
        $geoloc_a[1] = (Double)($geoloc_a[1]);

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

        $covoiturage = Covoiturage::create([
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
        dd($covoiturage->inscrits()->get());
        return 'hello';
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

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