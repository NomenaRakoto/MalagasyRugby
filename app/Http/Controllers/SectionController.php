<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Ligue;

class SectionController extends Controller
{
    //

    const SECTION_IMG_PATH = 'assets\img\app\section\\';

    public function __construct(){
        $this->middleware('auth');
    }

    public function list(Request $request){

    	$sections = Section::paginate(env('PAGINATION')); 
        
    	return view('section.list', [
    		"sections" => $sections
    	]);
    }


    public function form($id = null){

    	$ligues = Ligue::orderBy('nom')->get();
    	if($id) {
    		$section = Section::where('id', $id)->first();
    		return view('section.form', ['section' => $section, 'ligues' => $ligues]);

    	} else {
    		return view('section.form', ['ligues' => $ligues]);
    	}
    	
    }

    public function save(Request $request){
    	$request->validate([
    		'nom' => 'required',
    		'logo' => 'image'
    	]);

    	$isUpdate = false;

    	if(isset($request->id)) {
    		$isUpdate = true;
    		$section = Section::where('id', $request->id)->first();
    	}

    	$sectionData = $request->all();
    	unset($sectionData['_token']);
    	unset($sectionData['logo']);

    	if($request->logo) {
    		$imageName = time() . str_replace(' ', '', $request->nom) . '.' . $request->logo->extension();
    		$request->logo->move(public_path(self::SECTION_IMG_PATH), $imageName);
    		$sectionData['logo'] = $imageName;

    		if($isUpdate && $section->logo != 'defaultlogosection.jpg') {
    			unlink(self::SECTION_IMG_PATH . $section->logo);
    		}
    	} else {
    		if(!$isUpdate)
    			$sectionData['logo'] = 'defaultlogosection.jpg';
    	}
    	
    	if($isUpdate) {
    		$section->update($sectionData);
    	} else {
    		Section::create($sectionData);
    	}
    	
    	return redirect()->route('section.list');
    }

    public function delete($id, Request $request){

    	if(isset($id)) {
    		Section::where('id', $id)->delete();
    		return redirect()->route('section.list');
    	}
    	return redirect()->back();
    }

}
