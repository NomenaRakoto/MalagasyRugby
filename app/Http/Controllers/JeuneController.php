<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jeune;
use App\Models\Club;
use App\Models\Sexe;
use App\Models\Categorie;
use App\Models\Etude;
use App\Exports\JeuneExport;
use Maatwebsite\Excel\Facades\Excel;

class JeuneController extends Controller
{
    //
    const JEUNE_IMG_PATH = 'assets\img\app\jeunes\\';

    public function __construct(){
        $this->middleware('auth');
    }

    public function list(Request $request){

        //jeunes si cin est null. sinon c personnel
    	$jeunes = Jeune::whereNull('cin')->paginate(1000); 
        $male = Jeune::where('id_sexe',2)->whereNull('cin')->count();
        $female = Jeune::where('id_sexe',1)->whereNull('cin')->count();
    	return view('jeune.list', [
    		"jeunes" => $jeunes,
            "male" => $male,
            "female" => $female
    	]);
    }


    public function form($id = null){

    	$associations = Club::whereNotNull('type')->orderBy('nom')->get();
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
            'identification' => 'image'
    	]);

    	
        $isUpdate = false;
        if(isset($request->id)) {
            $isUpdate = true;
            $jeune = Jeune::where('id', $request->id)->first();
        }

        $jeuneData = $request->all();
    	unset($jeuneData['_token']);
        unset($jeuneData['identification']);
        if($request->identification) {
            $imageName = time() . str_replace(' ', '', $request->nom) . '.' . $request->identification->extension();
            $request->identification->move(public_path(self::JEUNE_IMG_PATH), $imageName);
            $jeuneData['identification'] = $imageName;

            if($isUpdate && $jeune->identification != 'pdp.jpg' && !empty($jeune->identification)) {
                unlink(self::JEUNE_IMG_PATH . $jeune->identification);
            }
        } else {
            if(!$isUpdate)
                $jeuneData['identification'] = 'pdp.jpg';
            elseif(empty($jeune->identification)) $jeuneData['identification'] = 'pdp.jpg';
            
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


    public function export()
    {
        return Excel::download(new JeuneExport, "jeune". time() .".xlsx");
    }
}
