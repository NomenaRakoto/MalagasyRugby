<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchRugby;
use App\Models\Club;
use App\Models\Scat;

class MatchController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function list(Request $request){
    	$matchs = MatchRugby::paginate(env('PAGINATION')); 
    	return view('match.list', [
    		"matchs" => $matchs
    	]);
    }

    public function form(Request $request, $id = null, ){

        $clubs = Club::orderBy('nom')->get();
        $scats = Scat::orderBy('designation')->get();

        if($id) {
            $match = MatchRugby::where('id', $id)->first();

            return view('match.form', ['clubs' => $clubs,'match' => $match, 'scats' => $scats ]);

        } else {
            return view('match.form', ['clubs' => $clubs, 'scats' => $scats ]);
        } 
    }

    public function save(Request $request){
    
        $request->validate([
            'date_match' => 'required',
            'heure' => 'required'
        ]);



        $isUpdate = false;

        if(isset($request->id)) {
            $isUpdate = true;
            $match = MatchRugby::where('id', $request->id)->first();
        }

        $matchData = $request->all();
        

        if($isUpdate) {
            $match->update($matchData);
        } else {
            MatchRugby::create($matchData);
        }
        
        return redirect()->route('match.list');
    }


    public function delete(Request $request){
        if(isset($request->matchs)) {
            MatchRugby::whereIn('id', json_decode($request->matchs))->delete();
        }

        return  redirect()->route('match.list');
    }

   

}
