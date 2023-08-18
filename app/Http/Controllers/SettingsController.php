<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scat;
use App\Models\Type;
use App\Models\Categorie;
use App\Models\Sexe;
use App\Models\Config;

class SettingsController extends Controller
{

    const LOGO_IMG_PATH = 'assets\img\\';

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
            'sexes' => $sexes,
            'nom_fmr' => self::getConfig('nom_federation'),
            'acronyme_fmr' => self::getConfig('acronyme_federation'),
            'saison' => self::getConfig('saison')
    	]);
    }

    public static function getConfig($varname)
    {
        return Config::where('varname', $varname)->first()->value;
    }

    public static function setConfig($varname, $value)
    {
        Config::where('varname', $varname)->update(["value" => $value]);
    }


    public function deleteScat(Request $request){
        if(isset($request->scats)) {
            Scat::whereIn('id', json_decode($request->scats))->delete();
        }

        return  redirect()->route('settings.main');
    }


    public function saveFmr(Request $request)
    {
        $request->validate([
            'nom_federation' => 'required',
            'acronyme_federation' => 'required',
            'logoFmr' => 'image',
            'saison' => 'required|numeric'
        ]);

        $fmrData = $request->all();
        

        if($request->logoFmr) {
            $request->logoFmr->move(public_path(self::LOGO_IMG_PATH), "malagasyrugby.jpg");
            
        }
        self::setConfig("nom_federation", $fmrData['nom_federation']);
        self::setConfig("acronyme_federation", $fmrData['acronyme_federation']);
        self::setConfig("saison", $fmrData['saison']);
        
        return redirect()->route('settings.main');
    }

    public function saveScat(Request $request)
    {
        $request->validate([
            'designation' => 'required',
            'min_age' => 'required',
            'max_age' => 'required'
        ]);

        $scatData = $request->all();
        unset($scatData['_token']);
       
        if(!empty($request->id)) {
            $scat = Scat::where('id', $request->id)->first();
            $scat->update($scatData);
        } else {

            Scat::create($scatData);
        }

        return redirect()->route('settings.main');
    }

    


   

}
