<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

	protected $table = 'notes';
	public $timestamps = true;
    public $guarded=['id','timestamps'];

	public function noteur()
	{
		return $this->belongsTo('App\Model\User', 'noteur_id');
	}

	public function notee()
	{
		return $this->belongsTo('App\Model\User', 'notee_id');
	}

}