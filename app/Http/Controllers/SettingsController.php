<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scat;
use App\Models\Type;
use App\Models\Categorie;
use App\Models\Sexe;
use App\Models\Config;
use App\Models\Etude;
use App\Models\User;
use ZipArchive;

class SettingsController extends Controller
{

    const LOGO_IMG_PATH = 'assets\img\\';
    const BACKUP_PATH = 'app\backups\\';

    const PERSO_IMG_PATH = 'assets\img\app\personnels\\';

    const SECTION_IMG_PATH = 'assets\img\app\section\\';

    const JEUNES_IMG_PATH = 'assets\img\app\jeunes\\';

    public function __construct(){
        $this->middleware('auth');
    }

    public function main(Request $request){

        $scats = Scat::paginate(env('PAGINATION'));

        $types = Type::get(); 
        $cats = Categorie::get(); 
        $sexes = Sexe::get();
        $niveaux = Etude::get();
        $users = User::get();


    	return view('settings.main', [
    		'scats' => $scats,
            'cats' => $cats,
            'types' => $types,
            'sexes' => $sexes,
            'niveaux' => $niveaux,
            'nom_fmr' => self::getConfig('nom_federation'),
            'acronyme_fmr' => self::getConfig('acronyme_federation'),
            'saison' => self::getConfig('saison'),
            'users' => $users
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

    public function deleteCat(Request $request){
        if(isset($request->cats)) {
            Categorie::whereIn('id', json_decode($request->cats))->delete();
        }

        return  redirect()->route('settings.main');
    }

    public function saveCat(Request $request)
    {
        $request->validate([
            'designation' => 'required'
        ]);

        $catData = $request->all();
        unset($catData['_token']);
       
        if(!empty($request->id)) {
            $cat = Categorie::where('id', $request->id)->first();
            $cat->update($catData);
        } else {

            Categorie::create($catData);
        }

        return redirect()->route('settings.main');
    }


     public function deleteNiveau(Request $request){
        if(isset($request->niveaus)) {
            Etude::whereIn('id', json_decode($request->niveaus))->delete();
        }

        return  redirect()->route('settings.main');
    }

    public function saveNiveau(Request $request)
    {
        $request->validate([
            'designation' => 'required'
        ]);

        $niveauData = $request->all();
        unset($niveauData['_token']);
       
        if(!empty($request->id)) {
            $cat = Etude::where('id', $request->id)->first();
            $cat->update($niveauData);
        } else {

            Etude::create($niveauData);
        }

        return redirect()->route('settings.main');
    }

    public function saveDb(Request $request)
    {
        foreach (glob(storage_path(self::BACKUP_PATH) . "*.zip") as $fichier) {
            try{
                unlink($fichier);
            } catch (Exception $e) {
                
            }
        }

        $filename = "db_backup-" . time() . ".sql";
  
        $command = '"C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe" --user=' . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " > " . storage_path(self::BACKUP_PATH) . $filename;

        $returnVar = NULL;
        $output  = NULL;
  
        exec($command, $output, $returnVar);

        $zip = new ZipArchive;
        $zipFileName = 'img-personnels.zip';

        if ($zip->open(storage_path(self::BACKUP_PATH . $zipFileName), ZipArchive::CREATE) === TRUE) {
            $filesToZip = \File::files(self::PERSO_IMG_PATH);

            foreach ($filesToZip as $file) {
                $zip->addFile($file, basename($file));
            }

            $zip->close();
        } else {
            return "Failed to create the zip file.";
        }

        $zip = new ZipArchive;
        $zipFileName = 'img-section.zip';

        if ($zip->open(storage_path(self::BACKUP_PATH . $zipFileName), ZipArchive::CREATE) === TRUE) {
            $filesToZip = \File::files(self::SECTION_IMG_PATH);

            foreach ($filesToZip as $file) {
                $zip->addFile($file, basename($file));
            }

            $zip->close();
        } else {
            return "Failed to create the zip file.";
        }

        $zip = new ZipArchive;
        $zipFileName = 'img-jeunes.zip';

        if ($zip->open(storage_path(self::BACKUP_PATH . $zipFileName), ZipArchive::CREATE) === TRUE) {
            $filesToZip = \File::files(self::JEUNES_IMG_PATH);

            foreach ($filesToZip as $file) {
                $zip->addFile($file, basename($file));
            }

            $zip->close();
        } else {
            return "Failed to create the zip file.";
        }

        $zip = new ZipArchive;
        $zipFileName = 'db_backup.zip';

        if ($zip->open(storage_path(self::BACKUP_PATH . $zipFileName), ZipArchive::CREATE) === TRUE) {
            $filesToZip = [
                storage_path(self::BACKUP_PATH . 'img-jeunes.zip'),
                storage_path(self::BACKUP_PATH . 'img-section.zip'),
                storage_path(self::BACKUP_PATH . 'img-personnels.zip'),
                storage_path(self::BACKUP_PATH) . $filename
            ];

            foreach ($filesToZip as $file) {
                $zip->addFile($file, basename($file));
            }

            $zip->close();
        } else {
            return "Failed to create the zip file.";
        }



        foreach (glob(storage_path(self::BACKUP_PATH) . "db_backup*.sql") as $fichier) {
            try{
                unlink($fichier);
            } catch (Exception $e) {
                
            }
        }

        foreach (glob(storage_path(self::BACKUP_PATH) . "img*.zip") as $fichier) {
            try{
                unlink($fichier);
            } catch (Exception $e) {
                
            }
        }

        return response()->download(storage_path(self::BACKUP_PATH . $zipFileName))->deleteFileAfterSend(true);

    }

     public function deleteUser(Request $request){
        if(isset($request->users)) {
            User::whereIn('id', json_decode($request->users))->delete();
        }

        return  redirect()->route('settings.main');
    }

    public function saveUser(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required'
        ]);


        $userData = $request->all();

        unset($userData['_token']);
        $userData['password'] = bcrypt($userData['password']);
       
        User::create($userData);

        return redirect()->route('settings.main');
    }



    


   

}
