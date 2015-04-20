<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Model\Ville;

abstract class Controller extends BaseController {

    use DispatchesCommands, ValidatesRequests;

    protected function getLonLat($geoloc){
        $geoloc = str_replace(["(", ")"], "", $geoloc);
        $geoloc = explode(",", $geoloc);
        $geoloc[0] = (Double)($geoloc[0]);
        $geoloc[1] = (Double)($geoloc[1]);
        return $geoloc;
    }

    protected  function covoituragesMoinDe($km,Ville $v,$limit=5){

        $latitude= $v->latitude;
        $longitude=$v->longitude;
        $formule="(6366*acos(cos(radians($latitude))*cos(radians(`latitude`))*cos(radians(`longitude`) -radians($longitude))+sin(radians($latitude))*sin(radians(`latitude`))))";
        $villes = Ville::with('departs')->select('id',DB::raw($formule.' as dist'))->where(DB::raw($formule) ,'<=', $km)->orderBy('dist','desc')->get();

        $covoituages =new Collection();
        foreach($villes as $ville){
            $ville->departs->load('villeDepart','villeArrivee','conducteur');
            foreach($ville->departs as $depart){
                $covoituages->prepend($depart);
            }
        }
        $covoituages = $covoituages->filter(function($covoituage){
            return $covoituage->date_depart > date("Y-m-d H:i:s");
        });
        return $covoituages->take($limit);
    }
}
