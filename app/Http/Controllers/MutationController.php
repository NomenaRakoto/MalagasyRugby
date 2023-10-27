<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutation;
use App\Models\Club;
use App\Models\Personnel;
use App\Exports\MutationExport;
use Maatwebsite\Excel\Facades\Excel;

class MutationController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function list(Request $request){
    	$mutations = Mutation::paginate(env('PAGINATION')); 
    	return view('mutation.list', [
    		"mutations" => $mutations
    	]);
    }

    public function form(Request $request, $id = null, ){

        $clubs = Club::orderBy('nom')->get();
        
        if($id) {
            $mutation = Mutation::where('id', $id)->first();
            return view('mutation.form', ['mutation' => $mutation, 'clubs' => $clubs]);

        } else {
            $personnel = Personnel::where('id', $request->id_perso)->first();
            return view('mutation.form', ['clubs' => $clubs, 'personnel' => $personnel]);
        } 
    }

    public function save(Request $request){
        $request->validate([
            'date_mutation' => 'required|date'
        ]);

        $isUpdate = false;

        if(isset($request->id)) {
            $isUpdate = true;
            $mutation = Mutation::where('id', $request->id)->first();
        }

        $mutationData = $request->all();
        

        if($isUpdate) {
            $mutation->update($mutationData);
        } else {
            Mutation::create($mutationData);
        }
        Personnel::where('id', $mutationData['id_joueur'])->update(['id_club' => $mutationData['id_new_club']]);
        
        return redirect()->route('mutation.list');
    }

    public function export()
    {
        return Excel::download(new MutationExport, "mutation". time() .".xlsx");
    }
   

}
