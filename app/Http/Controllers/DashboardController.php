<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scat;
use App\Models\Type;
use App\Models\Categorie;
use App\Models\Sexe;
use App\Models\Config;

class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function main(Request $request){
    	return view('dashboard.main', [
    		
    	]);
    }

}
