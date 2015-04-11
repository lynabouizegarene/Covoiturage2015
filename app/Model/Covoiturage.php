<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Covoiturage extends Model {

	protected $table = 'covoiturages';
	public $timestamps = true;

	public function villeDepart()
	{
		return $this->belongsTo('App\Model\Ville', 'ville_depart_id');
	}

	public function villeArrivee()
	{
		return $this->belongsTo('App\Model\Ville', 'ville_arrivee_id');
	}

	public function inscrits()
	{
		return $this->belongsToMany('App\Model\User','user_covoiturage_inscrits');
	}

	public function preinscrits()
	{
		return $this->belongsToMany('App\Model\User','user_covoiturage_preinscrits');
	}

	public function conducteur()
	{
		return $this->belongsTo('App\Model\User', 'conducteur_id');
	}

	public function commentaires()
	{
		return $this->hasMany('App\Model\Commentaire');
	}

}