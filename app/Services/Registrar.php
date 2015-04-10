<?php namespace App\Services;

use App\Model\Ville;
use App\Model\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'nom' => 'required|max:255|alpha',
            'prenom' => 'required|max:255|alpha',
            'genre' => 'required|in:Homme,Femme',
            'date_nais' => 'required|date',
            'num_tel' =>'required|regex:/^0[0-9]{8,9}$/',
            'ville' => 'required|max:255',
            'wilaya' => 'required|max:255',
            'geoloc' => 'required|max:255',
            'pref_musique' => 'required|boolean',
            'pref_animeaux' => 'required|boolean',
            'pref_discussion' => 'required|boolean',
            'pref_fumeur' => 'required|boolean',
            'photo' => 'image|size:5000', //format:jpeg,bmp,png et taille max:5000 kilobytes.
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
        $geoloc = $data['geoloc'];
        $geoloc = str_replace(["(",")"],"", $geoloc);
        $geoloc = explode(",",$geoloc);
        $geoloc[0] = (Double)($geoloc[0]);
        $geoloc[1] = (Double)($geoloc[1]);

        $ville=Ville::firstOrCreate([
            'nom'   => $data['ville'],
            'wilaya'=> $data['wilaya'],
            'longitude'=> $geoloc[0],
            'latitude'=> $geoloc[1],
        ]);
		$user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'nom' => ucfirst($data['nom']),
            'prenom' => ucfirst($data['prenom']),
            'genre' => $data['genre'],
            'date_nais' => $data['date_nais'],
            'num_tel' => $data['num_tel'],
            'ville_id' => $ville->getAttribute('id'),
            'pref_musique' => $data['pref_musique'],
            'pref_animeaux' => $data['pref_animeaux'],
            'pref_discussion' => $data['pref_discussion'],
            'pref_fumeur' => $data['pref_fumeur'],
            'description' => $data['description'],
        ]);
        if (Input::file('photo')->isValid()) {
            $destination = '../storage/app'; // path
            $fileName = $user->getAttribute('id').'.jpg'; // renameing image
            Input::file('photo')->move($destination , $fileName);
        }
        return $user;
	}

}
