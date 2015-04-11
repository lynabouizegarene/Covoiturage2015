<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

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
		return $this->belongsToMany('App\Model\Covoiturage','user_covoiturage_preinscrits');
	}

	public function inscriptions()
	{
		return $this->belongsToMany('App\Model\Covoiturage','user_covoiturage_inscrits');
	}

	public function conducteurCovoiturages()
	{
		return $this->hasMany('App\Model\Covoiturage', 'conducteur_id');
	}

}