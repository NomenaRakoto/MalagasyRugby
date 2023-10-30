<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scat;
use App\Models\Type;
use App\Models\Categorie;
use App\Models\Sexe;
use App\Models\Config;
use App\Models\Personnel;
use App\Models\Ligue;
use App\Models\Section;
use App\Models\Club;
use App\Models\MatchRugby;
use App\Models\Mutation;

class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function main(Request $request){
    	$data['ligue'] = Ligue::count();
    	$data['section'] = Section::count();
    	$data['club'] = Club::whereNotNull('type')->count();
    	$data['mutations'] = Mutation::count();
    	$data['matchs'] = MatchRugby::count();
    	$data['association'] = Club::whereNull('type')->count();
    	$data['joueurs'] = Personnel::where('id_type', 1)->count();
    	$data['dirigeants'] = Personnel::where('id_type', 2)->count();
    	$data['educateurs'] = Personnel::where('id_type', 4)->count();
    	$data['arbitres'] = Personnel::where('id_type', 2008)->count();
    	$data['medecins'] = Personnel::where('id_type', 2011)->count();
    	$data['jeunes'] = Personnel::whereNull('cin')->where('id_type', 2011)->count();
    	$data['jeunes_femmes'] = Personnel::whereNull('cin')->where('id_sexe', 1)->where('id_type', 2011)->count();
    	$data['jeunes_hommes'] = Personnel::whereNull('cin')->where('id_sexe', 2)->where('id_type', 2011)->count();
    	$data['joueurs_femmes'] = Personnel::where('id_type', 1)->where('id_sexe', 1)->count();
    	$data['joueurs_hommes'] = Personnel::where('id_type', 1)->where('id_sexe', 2)->count();
    	
    	return view('dashboard.main', [
    		'data' => $data 
    	]);
    }

}
