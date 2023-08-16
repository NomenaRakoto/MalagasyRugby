<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jeune;
use App\Models\Association;
use App\Models\Sexe;
use App\Models\Categorie;
use App\Models\Etude;

class JeuneController extends Controller
{
    //
    const JEUNE_IMG_PATH = 'assets\img\app\jeunes\\';

    public function __construct(){
        $this->middleware('auth');
    }

    public function list(Request $request){

    	$jeunes = Jeune::paginate(1000); 
        $male = Jeune::where('id_sexe',2)->count();
        $female = Jeune::where('id_sexe',1)->count();
    	return view('jeune.list', [
    		"jeunes" => $jeunes,
            "male" => $male,
            "female" => $female
    	]);
    }


    public function form($id = null){

    	$associations = Association::orderBy('nom')->get();
    	$etudes = Etude::orderBy('designation')->get();
    	$categories = Categorie::orderBy('designation')->get();
    	$sexes = Sexe::orderBy('designation')->get();

    	if($id) {
    		$jeune = Jeune::where('id', $id)->first();
    		return view('jeune.form', 
    		[
    		 'jeune' => $jeune,
    		 'associations' => $associations,
    		 'categories' => $categories,
    		 'etudes' => $etudes,
    		 'sexes' => $sexes,
    		]);

    	} else {
    		return view('jeune.form', 
    		[
    		'associations' => $associations,
    		 'categories' => $categories,
    		 'etudes' => $etudes,
    		 'sexes' => $sexes,
    		]);
    	}
    	
    }

    public function save(Request $request){

    	$request->validate([
    		'nom' => 'required',
    		'date_naissance' => 'required|date',
            'photo' => 'image'
    	]);

    	
        $isUpdate = false;
        if(isset($request->id)) {
            $isUpdate = true;
            $jeune = Jeune::where('id', $request->id)->first();
        }

        $jeuneData = $request->all();
    	unset($jeuneData['_token']);
        unset($jeuneData['photo']);
        if($request->photo) {
            $imageName = time() . str_replace(' ', '', $request->nom) . '.' . $request->photo->extension();
            $request->photo->move(public_path(self::JEUNE_IMG_PATH), $imageName);
            $jeuneData['photo'] = $imageName;

            if($isUpdate && $jeune->photo != 'pdp.jpg' && !empty($jeune->photo)) {
                unlink(self::JEUNE_IMG_PATH . $jeune->photo);
            }
        } else {
            if(!$isUpdate)
                $jeuneData['photo'] = 'pdp.jpg';
            elseif(empty($jeune->photo)) $jeuneData['photo'] = 'pdp.jpg';
            
        }

    	if(isset($request->id)) {
    		$jeune->update($jeuneData);
    	} else {
    		Jeune::create($jeuneData);
    	}
    	
    	return redirect()->route('jeune.list');
    }

    public function delete(Request $request){
    	if(isset($request->jeunes)) {

    		Jeune::whereIn('id', json_decode($request->jeunes))->delete();
    		return redirect()->route('jeune.list');
    	}
    	return redirect()->back();
    }



    public function print(Request $request){
            $jeunes = Jeune::whereIn('id', json_decode($request->jeunes))->get();
    		return view('licence', ["jeunes" => $jeunes]);
    }
}
