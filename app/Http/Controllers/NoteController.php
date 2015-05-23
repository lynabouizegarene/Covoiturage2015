<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Model\Note;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller {


	/**
	 * Noter un utilisateur
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request,[
            'user_id'=>'required|numeric',
            'note'=>'required|between:1,5',
            'avis'=>'required'
        ]);

        $data=$request->all();
        $user=User::findOrFail($data['user_id']);

        $note=Note::firstOrCreate([
            'noteur_id'=>Auth::User()->id,
            'notee_id'=>$user->id
        ]);

        $note->note = $data['note'];
        $note->avis = $data['avis'];
        $note->save();
        return redirect()->back();
	}
}
