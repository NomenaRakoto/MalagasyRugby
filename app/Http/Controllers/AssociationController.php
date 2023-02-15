<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Association;
use App\Models\Ligue;

class AssociationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function list(Request $request){
    	
    	$associations = Association::paginate(env('PAGINATION')); 
    	return view('association.list', [
    		"associations" => $associations
    	]);
    }


    public function form($id = null){

    	$ligues = Ligue::orderBy('nom')->get();
    	if($id) {
    		$association = Association::where('id', $id)->first();
    		return view('association.form', ['association' => $association, 'ligues' => $ligues]);

    	} else {
    		return view('association.form', ['ligues' => $ligues]);
    	}
    	
    }

    public function save(Request $request){
    	$request->validate([
    		'nom' => 'required'
    	]);

    	$associationData = $request->all();
    	unset($associationData['_token']);
    	if(isset($request->id)) {
    		$association = Association::where('id', $request->id)->first();
    		$association->update($associationData);
    	} else {
    		Association::create($associationData);
    	}
    	
    	return redirect()->route('association.list');
    }

    public function delete($id, Request $request){

    	if(isset($id)) {
    		Association::where('id', $id)->delete();
    		return redirect()->route('association.list');
    	}
    	return redirect()->back();
    }
}
