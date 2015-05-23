<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Storage;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract{

    use Authenticatable, CanResetPassword;

	protected $table = 'users';
	public $timestamps = true;
	protected $guarded = array('id', 'remember_token', 'timestamps');

	public function ville()
	{
		return $this->belongsTo('App\Model\Ville');
	}

	public function notifications()
	{
		return $this->hasMany('App\Model\Notification');
	}

	public function commentaires()
	{
		return $this->hasMany('App\Model\Commentaire');
	}

	public function preinscriptions()
	{
		return $this->belongsToMany('App\Model\Covoiturage','user_covoiturage_preinscrits')->withTimestamps();
	}

	public function inscriptions()
	{
		return $this->belongsToMany('App\Model\Covoiturage','user_covoiturage_inscrits')->withTimestamps();
	}

	public function conducteurCovoiturages()
	{
		return $this->hasMany('App\Model\Covoiturage', 'conducteur_id');
	}

    public function notesRecu()
    {
        return $this->hasMany('App\Model\Note', 'notee_id');
    }

    public function notesAttribuer()
    {
        return $this->hasMany('App\Model\Note', 'noteur_id');
    }


    public function pathPhoto($prefix = '')
    {
        $file = $this->id . '.jpg';
        if (Storage::exists($file)) {
            $pathPhoto = '../storage/app/'. $prefix . $file;
        } elseif ($this->genre == 'Homme') {
            $pathPhoto = '../storage/app/'. $prefix .'Homme.jpg';
        } else {
            $pathPhoto = '../storage/app/'. $prefix .'Femme.jpg';
        }
        return $pathPhoto;
    }

    public function moyenneAvis(){
        $somme=0;
        $nb_notes=$this->notesRecu->count();
        foreach($this->notesRecu as $note)
        {
            $somme = $somme + $note->note;
        }
        if($nb_notes==0)
            return null;
        else
            return ['moyenne' => number_format($somme/$nb_notes,1),'nb_note'=>$nb_notes];
    }
}