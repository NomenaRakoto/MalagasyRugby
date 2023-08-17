<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scat;
use App\Models\Type;
use App\Models\Categorie;
use App\Models\Sexe;

class SettingsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function main(Request $request){

        $scats = Scat::paginate(env('PAGINATION'));

        $types = Type::get(); 
        $cats = Categorie::get(); 
        $sexes = Sexe::get(); 
    	return view('settings.main', [
    		'scats' => $scats,
            'cats' => $cats,
            'types' => $types,
            'sexes' => $sexes
    	]);
    }


    public function deleteScat(Request $request){
        if(isset($request->matchs)) {
            MatchRugby::whereIn('id', json_decode($request->matchs))->delete();
        }

        return  redirect()->route('match.list');
    }

    


   

}
