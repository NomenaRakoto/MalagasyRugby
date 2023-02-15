<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Section;
use App\Models\Personnel;
use App\Exports\StatsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function list(Request $request){

    	$clubs = Club::paginate(env('PAGINATION')); 
    	return view('club.list', [
    		"clubs" => $clubs
    	]);
    }

    public function personnels($id_club){

        $persos = Personnel::where('id_club', '=', $id_club)->paginate(env('PAGINATION')); 
        $club = Club::where('id','=', $id_club)->first();
        return view('personnel.list', [
            "personnels" => $persos,
            "club" => $club
        ]);
    }

    public function search(Request $request){
        $queries = $request->all();
        $clubs = Club::where(DB::raw("LOWER(CONCAT(nom,responsable,contact,adresse,observation,mail_adresse, fb_adresse))"), 'LIKE', "%".strtolower($queries['query'])."%");
        $clubs = $clubs->paginate(env('PAGINATION'));
        $clubs->appends($queries['query']);
        return view('club.list', [
            "clubs" => $clubs,
            "query" => $queries['query']
        ]);
    }


    public function form($id = null){

    	$sections = Section::orderBy('nom')->get();
    	if($id) {
    		$club = Club::where('id', $id)->first();
    		return view('club.form', ['club' => $club, 'sections' => $sections]);

    	} else {
    		return view('club.form', ['sections' => $sections]);
    	}
    	
    }

    public function save(Request $request){
    	$request->validate([
    		'nom' => 'required'
    	]);

    	$clubData = $request->all();
    	unset($clubData['_token']);
    	if(isset($request->id)) {
    		$club = Club::where('id', $request->id)->first();
    		$club->update($clubData);
    	} else {
    		Club::create($clubData);
    	}
    	
    	return redirect()->route('club.list');
    }

    public function delete($id, Request $request){

    	if(isset($id)) {
    		Club::where('id', $id)->delete();
    		return redirect()->route('club.list');
    	}
    	return redirect()->back();
    }

    public function stats()
    {
        return Excel::download(new StatsExport, "statistiques". time() .".xlsx");
    }
}
