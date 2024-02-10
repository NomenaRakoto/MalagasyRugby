<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ligue;
use App\Models\Section;
use App\Exports\LigueExport;
use Maatwebsite\Excel\Facades\Excel;

class LigueController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function list(Request $request){

    	$ligues = Ligue::paginate(env('PAGINATION')); 
    	return view('ligue.list', [
    		"ligues" => $ligues
    	]);
    }


    public function form($id = null){

    	if($id) {
    		$ligue = Ligue::where('id', $id)->first();
    		return view('ligue.form', ['ligue' => $ligue]);

    	} else {
    		return view('ligue.form');
    	}
    	
    }

    public function save(Request $request){
    	$request->validate([
    		'nom' => 'required'
    	]);

    	$ligueData = $request->all();
    	unset($ligueData['_token']);
    	if(isset($request->id)) {
    		$ligue = Ligue::where('id', $request->id)->first();
    		$ligue->update($ligueData);
    	} else {
    		Ligue::create($ligueData);
    	}
    	
    	return redirect()->route('ligue');
    }

    public function delete($id, Request $request){

    	if(isset($id)) {
    		Ligue::where('id', $id)->delete();
    		return redirect()->route('ligue');
    	}
    	return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new LigueExport, "ligue". time() .".xlsx");
    }

    public function sections($id_ligue){

        $sections = Section::where('id_ligue', $id_ligue)->paginate(env('PAGINATION')); 
        $ligue = Ligue::find($id_ligue);
        
        return view('section.list', [
            "sections" => $sections,
            'ligue' => $ligue
        ]);
    }

}
