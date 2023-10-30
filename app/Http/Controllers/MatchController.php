<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchRugby;
use App\Models\Club;
use App\Models\Categorie;
use App\Models\Personnel;
use App\Models\JoueursEssai;
use App\Models\JoueursCartonJaune;
use App\Models\JoueursCartonRouge;
use App\Models\JoueursCommotionCerebrale;
use App\Exports\MatchExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $cats = Categorie::orderBy('designation')->get();
        if(count($clubs) > 0)
        $persos = Personnel::whereIn('id_club', [$clubs[0]->id])->get();
        else $persos = [];
        if($id) {
            $match = MatchRugby::where('id', $id)->first();
            $persos = Personnel::whereIn('id_club', [$match->club_home->id, $match->club_guest->id])->get();
            $joueursEssai = JoueursEssai::where('id_match', $match->id)->pluck('id_perso')->toArray();
            $joueursCartonJaune = joueursCartonJaune::where('id_match', $match->id)->pluck('id_perso')->toArray();
            $joueursCartonRouge = joueursCartonRouge::where('id_match', $match->id)->pluck('id_perso')->toArray();

            $joueursCommotionCerebrale = JoueursCommotionCerebrale::where('id_match', $match->id)->pluck('id_perso')->toArray();
            
            return view('match.form', ['clubs' => $clubs,'match' => $match, 'cats' => $cats, 'persos' => $persos, 'joueursEssai' => $joueursEssai, 'joueursCartonJaune' => $joueursCartonJaune, 'joueursCartonRouge' => $joueursCartonRouge, 'joueursCommotionCerebrale' => $joueursCommotionCerebrale]);

        } else {
            return view('match.form', ['clubs' => $clubs, 'cats' => $cats, 'persos' => $persos  ]);
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
        if(isset($matchData['joueurs_essai'])) {
            $joueurs_essai = $matchData['joueurs_essai'];
            unset($matchData['joueurs_essai']);
        }

        if(isset($matchData['joueurs_carton_jaune'])) {
            $joueurs_carton_jaune = $matchData['joueurs_carton_jaune'];
            unset($matchData['joueurs_carton_jaune']);
        }

        if(isset($matchData['joueurs_carton_rouge'])) {
            $joueurs_carton_rouge = $matchData['joueurs_carton_rouge'];
            unset($matchData['joueurs_carton_rouge']);
        }

         if(isset($matchData['joueurs_commotion_cerebrale'])) {
            $joueurs_commotion_cerebrale = $matchData['joueurs_commotion_cerebrale'];
            unset($matchData['joueurs_commotion_cerebrale']);
        }
        
      
        
        if($isUpdate) {
            $match->update($matchData);
        } else {
            $match = MatchRugby::create($matchData);
        }

        JoueursEssai::where('id_match', $match->id)->delete();

        if(isset($joueurs_essai) && intval($matchData['nb_essai']) > 0) {
           foreach ($joueurs_essai as $key => $joueur) {
                JoueursEssai::create(["id_match" =>  $match->id, "id_perso" => $joueur]);
            } 
        }
        

        JoueursCartonJaune::where('id_match', $match->id)->delete();
        if(isset($joueurs_carton_jaune) && intval($matchData['nb_carton_jaune']) > 0) {
            foreach ($joueurs_carton_jaune as $key => $joueur) {
                JoueursCartonJaune::create(["id_match" =>  $match->id, "id_perso" => $joueur]);
            }
        }
        
        JoueursCartonRouge::where('id_match', $match->id)->delete();
        if(isset($joueurs_carton_rouge) && intval($matchData['nb_carton_rouge']) > 0) {
            foreach ($joueurs_carton_rouge as $key => $joueur) {
                JoueursCartonRouge::create(["id_match" =>  $match->id, "id_perso" => $joueur]);
            } 
        }

        JoueursCommotionCerebrale::where('id_match', $match->id)->delete();
        if(isset($joueurs_commotion_cerebrale) && intval($matchData['commotion_cerebrale']) > 0) {
            foreach ($joueurs_commotion_cerebrale as $key => $joueur) {
                JoueursCommotionCerebrale::create(["id_match" =>  $match->id, "id_perso" => $joueur]);
            } 
        }
       
        
        
        return redirect()->route('match.list');
    }


    public function delete(Request $request){
        if(isset($request->matchs)) {
            MatchRugby::whereIn('id', json_decode($request->matchs))->delete();

            JoueursEssai::whereIn('id_match', json_decode($request->matchs))->delete();
            JoueursCartonJaune::whereIn('id_match', json_decode($request->matchs))->delete();
            JoueursCartonRouge::whereIn('id_match', json_decode($request->matchs))->delete();

        }

        return  redirect()->route('match.list');
    }

    public function joueurs(Request $request){

        $persos = Personnel::whereIn('id_club', [$request->id_club1, $request->id_club2])->get();
        if(count($persos) > 0)
        return view('match.joueurs',['persos'=> $persos])->render();
    }

    public function export()
    {
        return Excel::download(new MatchExport, "match". time() .".xlsx");
    }

   

}
