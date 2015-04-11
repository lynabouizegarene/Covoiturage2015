<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

	protected $table = 'notifications';
	public $timestamps = true;
	protected $guarded = array('contenu');

	public function user()
	{
		return $this->belongsTo('App\Model\User');
	}

}