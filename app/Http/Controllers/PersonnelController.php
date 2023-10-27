<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\Scat;
use App\Models\Club;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Exports\PersonnelExport;
use Maatwebsite\Excel\Facades\Excel;

class PersonnelController extends Controller
{
    //

    const PERSO_IMG_PATH = 'assets\img\app\personnels\\';

    const PERSO_JOUEURS_TYPE = 1;

    const SENIOR_MIN_AGE = 21;

    public function __construct(){
        $this->middleware('auth');
    }

    public function list(Request $request){

    	$persos = Personnel::whereNotNull('cin')->paginate(1000); 
        $male = Personnel::where('id_sexe',2)->whereNotNull('cin')->count();
        $female = Personnel::where('id_sexe',1)->whereNotNull('cin')->count();
    	return view('personnel.list', [
    		"personnels" => $persos,
            "male" => $male,
            "female" => $female
    	]);
    }

    public function search(Request $request){

        
        $queries = $request->all();
        
        if(isset($queries['query']) || isset($queries['saison'])) {
            $request->session()->put('queries', $request->all());
            $queries = $request->session()->get('queries');
        } else {
            if($request->session()->has('queries')) {
                $queries = $request->session()->get('queries'); 
            }
            
            else {
                
                return redirect(route('personnel.list'));
            }
                
        }

       
        if(!empty($queries) ) {
            $query = str_replace(' ', '',  $queries['query']);
            $persos = new Personnel;
            if(!empty($queries['query'])) {
                
                $persos = $persos->where(DB::raw("LOWER(CONCAT(coalesce(nom,''),coalesce(prenom,''),coalesce(cin,''),coalesce(licence,'')))"), 'LIKE', "%".strtolower($query)."%");

            }


            if(!empty($queries['saison'])) {

                $persos = $persos->where('annee_validite', '=', trim($queries['saison']));
            }

            $persos = $persos->paginate(1000);
            $persos->appends($queries['query']);
            return view('personnel.list', [
                "personnels" => $persos,
                "query" => (isset($queries['query'])) ? $queries['query'] : '',
                'club' => (isset($_GET['id_club'])) ? Club::where('id','=',  $_GET['id_club'])->first() : null,
                'saison' => (isset($queries['saison'])) ? $queries['saison'] : ''
            ]);
        } else {
            return redirect(route('personnel.list'));
        }

        
    }

    public function doute($nom_prenom, $cin = null){
        if($nom_prenom || $cin) {
            $nom_prenom = strtoupper($nom_prenom);
            $persos = Personnel::where(DB::raw("upper(CONCAT(nom,prenom))"), 'LIKE', "%".$nom_prenom."%")
                      ->orWhere('cin', 'LIKE', "%".$cin."%");
            $persos = $persos->paginate(1000);
            return view('personnel.list', [
                "personnels" => $persos
            ]);
        }
        
    }

    public function checkScat(Request $request){
        $scats = $this->getScat($request->date_naissance, $request->sexe, $request->type);
        if(count($scats) > 0)
        return view('personnel.scat',['scats'=> $scats])->render();

    }

    private function getScat($date_naissance, $sexe, $type) 
    {
        if($type == self::PERSO_JOUEURS_TYPE) {
            $age = Carbon::parse($date_naissance)->age;
            $isSenior = $age >= self::SENIOR_MIN_AGE;

            if($isSenior) {
                $scats = Scat::where("id_type", $type)->whereIn('id_sexe', [0, $sexe])->where('min_age', '<=', $age)->where('max_age', '>=', $age)->get();

            } else {
                $scats = Scat::where("id_type", $type)->whereIn('id_sexe', [0, $sexe])->where('min_age', '<=', $age)->where('max_age', '>=', $age)->get();
                
            }
        } else {
            $scats = Scat::where("id_type", $type)->get();
        }
        return $scats;

    }


     public function print(Request $request){
            $persos = Personnel::whereIn('id', json_decode($request->personnels))->get();
            /*$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('a4', 'landscape')->loadView('licence',  ["persos" => $persos]);
              // download PDF file with download method
            return $pdf->download('licence.pdf');*/
    		return view('licence', ["persos" => $persos]);
    	
    }

    public function form($id = null){
        $clubs =  Club::orderBy('nom')->get();
        $types = $this->getConfigData("type");
        $sexes = $this->getConfigData("sexe");
        $selections = $this->getConfigData("selection_type");
        $formats_jeu = $this->getConfigData("format_jeu");
        $positions_jeu = $this->getConfigData("position_jeu");
        $statuts_regle = $this->getConfigData("statut_regle");
        $statuts_citoyen = $this->getConfigData("statut_citoyennete");
        $niveau_equipes = $this->getConfigData("niveau_equipe");
        $licence = $this->getConfig('licence');
        $last_cin = $this->getConfig('cin');

        if($id) {
            $personnel = Personnel::where('id', $id)->first();
            $scats = $this->getScat($personnel->date_naissance, $personnel->id_sexe, $personnel->id_type);
            return view('personnel.form', 
            [
             'personnel' => $personnel,
             'clubs' => $clubs,
             'types' => $types,
             'scats' => $scats,
             'sexes' => $sexes,
             'formats_jeu' => $formats_jeu,
             'positions_jeu' => $positions_jeu,
             'statuts_regle' => $statuts_regle,
             'statuts_citoyen' => $statuts_citoyen,
             'niveau_equipes' => $niveau_equipes,
             'current_club' => (isset($_GET['id_club'])) ? $_GET['id_club'] : null,
             'selections' => $selections
            ]);

        } else {
            $scats = $this->getConfigData("scat");
            return view('personnel.form', 
            [
             'clubs' => $clubs,
             'types' => $types,
             'scats' => $scats,
             'sexes' => $sexes,
             'formats_jeu' => $formats_jeu,
             'positions_jeu' => $positions_jeu,
             'statuts_regle' => $statuts_regle,
             'statuts_citoyen' => $statuts_citoyen,
             'niveau_equipes' => $niveau_equipes,
             'last_cin' => intval($last_cin) + 1,
             'licence' => intval($licence) + 1,
             'current_club' => (isset($_GET['id_club'])) ? $_GET['id_club'] : null,
             'selections' => $selections
            ]);
        }
        
    }

    public function save(Request $request){
    
        $isUpdate = false;
        if(isset($request->id)) {
            $isUpdate = true;
            $personnel = Personnel::where('id', $request->id)->first();
        }
        if($isUpdate) {

             $request->validate([
                'nom' => 'required',
                'date_naissance' => 'required|date',
                'identification' => 'image',
                'cin' => 'required|unique:personnel,cin,'. $personnel->id .'|max:12'
            ]);

        } else {

            $request->validate([
                'nom' => 'required',
                'date_naissance' => 'required|date',
                'identification' => 'image',
                'cin' => 'required|unique:personnel|max:12'
            ]);
        }
        

        $personnelData = $request->all();
        unset($personnelData['_token']);
        unset($personnelData['identification']);

        if($request->identification) {
            $imageName = time() . str_replace(' ', '', $request->nom) . '.' . $request->identification->extension();
            $request->identification->move(public_path(self::PERSO_IMG_PATH), $imageName);
            $personnelData['identification'] = $imageName;

            if($isUpdate && $personnel->identification != 'pdp.jpg' && !empty($personnel->identification)) {
                if(file_exists(self::PERSO_IMG_PATH . $personnel->identification))
                    unlink(self::PERSO_IMG_PATH . $personnel->identification);
            }
        } else {
            if(!$isUpdate)
                $personnelData['identification'] = 'pdp.jpg';
            elseif(empty($personnel->identification)) $personnelData['identification'] = 'pdp.jpg';
            
        }

        if(isset($request->id)) {
            $personnel->update($personnelData);
        } else {
            $this->updateConfig('licence', intval($this->getConfig('licence')) + 1);
            $this->updateConfig('cin', intval($this->getConfig('cin')) + 1);
            Personnel::create($personnelData);
        }
        
        return (isset($_GET['current_club'])) ? redirect()->route('club.personnel.list', ['id_club' => $_GET['current_club']]) : redirect()->route('personnel.list');
    }

    private function getConfigData($table)
    {
        return DB::table($table)->orderBy('designation')->get();
    }

    private function getConfig($varname)
    {
        return DB::table('config')->where('varname', $varname)->first()->value;
    }

    private function updateConfig($varname, $value)
    {
        return DB::table('config')->where('varname', $varname)->update([
            'value' => $value
        ]);
    }

    public function delete(Request $request){
        if(isset($request->personnels)) {
            Personnel::whereIn('id', json_decode($request->personnels))->delete();
        }
        return (isset($_GET['current_club'])) ? redirect()->route('club.personnel.list', ['id_club' => $_GET['current_club']]) : redirect()->route('personnel.list');
    }


    public function export()
    {
        return Excel::download(new PersonnelExport, "personnel". time() .".xlsx");
    }
}
