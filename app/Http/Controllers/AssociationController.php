<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Ligue;
use App\Models\Jeune;
use App\Models\TypeAssociation;
use App\Exports\AssociationExport;
use Maatwebsite\Excel\Facades\Excel;

class AssociationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function list(Request $request){
    	//Si type == null, C'est un club mais pas association ou etablissement
    	$associations = Club::whereNotNull('type')->paginate(env('PAGINATION')); 
    	return view('association.list', [
    		"associations" => $associations
    	]);
    }


     public function jeunes($id_association){

        $jeunes = Jeune::where('id_club', '=', $id_association)->paginate(env('PAGINATION')); 
        $association = Club::where('id','=', $id_association)->first();
        return view('jeune.list', [
            "jeunes" => $jeunes,
            "association" => $association
        ]);
    }

    public function form($id = null){

    	$ligues = Ligue::orderBy('nom')->get();
        $types = TypeAssociation::orderBy('designation')->get();
    	if($id) {
    		$association = Club::where('id', $id)->first();
    		return view('association.form', ['association' => $association, 'ligues' => $ligues, 'types' => $types]);

    	} else {
    		return view('association.form', ['ligues' => $ligues, 'types' => $types]);
    	}
    	
    }

    public function save(Request $request){
    	$request->validate([
    		'nom' => 'required'
    	]);

    	$associationData = $request->all();
    	unset($associationData['_token']);
    	if(isset($request->id)) {
    		$association = Club::where('id', $request->id)->first();
    		$association->update($associationData);
    	} else {
    		Club::create($associationData);
    	}
    	
    	return redirect()->route('association.list');
    }

    public function delete($id, Request $request){

    	if(isset($id)) {
    		Club::where('id', $id)->delete();
    		return redirect()->route('association.list');
    	}
    	return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new AssociationExport, "association". time() .".xlsx");
    }
}
