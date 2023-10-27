<?php

namespace App\Exports;

use App\Models\Club;
use App\Models\Personnel;
use Maatwebsite\Excel\Concerns\FromArray;
 use Illuminate\Support\Facades\DB;


class StatsExport implements FromArray
{
    public function array(): array
    {
        $persos = Personnel::select('id_club', 'id_type', 'id_sexe', 'id_s_cat', DB::raw('COUNT(*) as nb'))
        ->groupBy('id_club', 'id_type', 'id_sexe', 'id_s_cat')
        ->get();
    	$data = [
    		["","","","","","","","","","","","","","",
    		"","", 
    		"ARBITRE", "", "","", "","",/*Arbitre*/
    		"ENTRAINEUR", "", "","", "","",/*Entraineur*/
    		"DOCTEUR", "", "","", "","",/*Docteur*/
    		"PREPARATEUR PHYSIQUE", "", "","", "","",/*Preparateur physique*/
    		"DIRIGEANT", "",
    		"", "",
    		"", "",
    		"", "",
    		"", "",
    		"", ""],

    		["Club","ETAT","MINIME U15","","CADET U17","","JUNIOR U20","","3e DIV","","2e DIV U16","","D1 (F)","1er ELITE II","",
    		"1er Div Regional","Federal 1", "Federal 2", 
    		"Niv I", "", "Niv II","", "Niv III","",/*Arbitre*/
    		"Niv I", "", "Niv II","", "Niv III","",/*Entraineur*/
    		"Niv I", "", "Niv II","", "Niv III","",/*Docteur*/
    		"Niv I", "", "Niv II","", "Niv III","",/*Preparateur physique*/
    		"EDUCATEUR", "",
    		"PRESIDENT", "",
    		"VICE PRESIDENT", "",
    		"TRESORIER", "",
    		"SG", "",
    		"CONSEILLER", ""],
    		[
    			"",
    			"",
    			"F","M",//Minime U16,
    			"F","M",//cadet U18
    			"F","M",//junior u20
    			"F","M",//3e div
    			"F","M",//2e div
    			"F",//D1 (F)
    			"F","M",//1er elite II
    			"M",//1er Div Regional
    			"M",//1er Div Federal
    			"M",//2e Div Federal
    			"F","M",//Arbitre niv I
    			"F","M",//Arbitre niv II
    			"F","M",//Arbitre Niv III
    			"F","M",//Entraineur Niv I
    			"F","M",//Entraineur Niv II
    			"F","M",//Entraineur Niv III
    			"F","M",//Docteur Niv I
    			"F","M",//Docteur Niv II
    			"F","M",//Docteur Niv III
    			"F","M",//Prep physique Niv I
    			"F","M",//Prep physique Niv II
    			"F","M",//Prep physique Niv III
    			"F","M",//educateur
    			"F","M",//President
    			"F","M",//Vice President
    			"F","M",//Tresorier
    			"F","M",//SG
    			"F","M"//Conseiller
    		]
    	];

        $clubs = Club::all();
        
        foreach ($clubs as $key => $club) {
            $row = [];
            $row[] = $club->nom;
            $row[] = $club->actif;
            //Minime u16
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 10)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 10)->where('id_sexe',2)->count());

            //Cadet u18
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 11)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 11)->where('id_sexe',2)->count());

            //Junior u20
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4023)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4023)->where('id_sexe',2)->count());

            //3e Div
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 6)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 6)->where('id_sexe',2)->count());

            //2e Div
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 5)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->whereIn('id_s_cat', [8, 4022])->count());

            //D1 F
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 7)->count());

            //1er elite II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4)->where('id_sexe',2)->count());

            //1er div elite regional
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 2016)->count());

            //1er div Federal
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 3)->count());
            //2e div Federal
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 3016)->count());

            //Arbitre niv I
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2008)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2008)->where('id_sexe',2)->count());

            //Arbitre niv II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2008)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2008)->where('id_sexe',2)->count());

            //Arbitre niv III
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2008)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2008)->where('id_sexe',2)->count());

            //Entraineur niv I
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2010)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2010)->where('id_sexe',2)->count());

            //Entraineur niv II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2010)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2010)->where('id_sexe',2)->count());

            //Entraineur niv III
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2010)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2010)->where('id_sexe',2)->count());


            //Docteur niv I
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2011)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2011)->where('id_sexe',2)->count());

            //Docteur niv II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2011)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2011)->where('id_sexe',2)->count());

            //Docteur niv III
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2011)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2011)->where('id_sexe',2)->count());

            //Prep physique niv I
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2009)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2009)->where('id_sexe',2)->count());

            //Prep physique niv II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2009)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2009)->where('id_sexe',2)->count());

            //Prep physique niv III
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2009)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2009)->where('id_sexe',2)->count());

            //Educateur
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_type', 4)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_type', 4)->where('id_sexe',2)->count());

            //President
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4017)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4017)->where('id_type', 2)->where('id_sexe',2)->count());

            //Vice President
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4018)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4018)->where('id_type', 2)->where('id_sexe',2)->count());

            //Tresorier
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4016)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4016)->where('id_type', 2)->where('id_sexe',2)->count());

            //Conseiller
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4020)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4020)->where('id_type', 2)->where('id_sexe',2)->count());

            //SG
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4019)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4019)->where('id_type', 2)->where('id_sexe',2)->count());

            $data[] = $row;
        }

        return $data;
    	
    }

    private function sommeStat($data, $id_club, $id_sexe, $id_type, $id_s_cat)
    {
        $nb = 0;
        $condition = 'return (($stat->id_club == $id_club)';
        if(!is_null($id_sexe)) $condition.= ' && ($stat->id_sexe == $id_sexe)';
        if(!is_null($id_type)) $condition.= ' && ($stat->id_type == $id_type)';
        if(!is_null($id_s_cat)) $condition.= ' && (in_array($stat->id_s_cat, $id_s_cat))';
        $condition.= ');';

        foreach ($data as $key => $stat) {
            if(eval($condition)) {
                $nb += $stat->nb;
            }
        }

        return $nb;
    }
}


/*
public function array(): array
    {
        

        $clubs = Club::all();
        
        foreach ($clubs as $key => $club) {
            $row = [];
            $row[] = $club->nom;
            $row[] = $club->actif;
            //Minime u16
            $row[] = strval(DB::table('synthese')->where("id_club", $club->id)->where('id_s_cat', 10)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 10)->where('id_sexe',2)->count());

            //Cadet u18
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 11)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 11)->where('id_sexe',2)->count());

            //Junior u20
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4023)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4023)->where('id_sexe',2)->count());

            //3e Div
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 6)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 6)->where('id_sexe',2)->count());

            //2e Div
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 5)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->whereIn('id_s_cat', [8, 4022])->count());

            //D1 F
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 7)->count());

            //1er elite II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4)->where('id_sexe',2)->count());

            //1er div elite regional
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 2016)->count());

            //1er div Federal
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 3)->count());
            //2e div Federal
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 3016)->count());

            //Arbitre niv I
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2008)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2008)->where('id_sexe',2)->count());

            //Arbitre niv II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2008)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2008)->where('id_sexe',2)->count());

            //Arbitre niv III
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2008)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2008)->where('id_sexe',2)->count());

            //Entraineur niv I
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2010)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2010)->where('id_sexe',2)->count());

            //Entraineur niv II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2010)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2010)->where('id_sexe',2)->count());

            //Entraineur niv III
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2010)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2010)->where('id_sexe',2)->count());


            //Docteur niv I
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2011)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2011)->where('id_sexe',2)->count());

            //Docteur niv II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2011)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2011)->where('id_sexe',2)->count());

            //Docteur niv III
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2011)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2011)->where('id_sexe',2)->count());

            //Prep physique niv I
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2009)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 12)->where('id_type', 2009)->where('id_sexe',2)->count());

            //Prep physique niv II
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2009)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 13)->where('id_type', 2009)->where('id_sexe',2)->count());

            //Prep physique niv III
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2009)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 14)->where('id_type', 2009)->where('id_sexe',2)->count());

            //Educateur
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_type', 4)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_type', 4)->where('id_sexe',2)->count());

            //President
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4017)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4017)->where('id_type', 2)->where('id_sexe',2)->count());

            //Vice President
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4018)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4018)->where('id_type', 2)->where('id_sexe',2)->count());

            //Tresorier
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4016)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4016)->where('id_type', 2)->where('id_sexe',2)->count());

            //Conseiller
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4020)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4020)->where('id_type', 2)->where('id_sexe',2)->count());

            //SG
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4019)->where('id_type', 2)->where('id_sexe',1)->count());
            $row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4019)->where('id_type', 2)->where('id_sexe',2)->count());

            $data[] = $row;
        }

        return $data;
    }
*/

/*
class StatsExport implements FromArray
{
    public function array(): array
    {
        

        $clubs = Club::all();
        
        foreach ($clubs as $key => $club) {
            $row = [];
            $row[] = $club->nom;
            $row[] = $club->actif;
            //Minime u16
            $row[] = strval($this->sommeStat($persos, $club->id, 1, null, [10]));


            $row[] = strval($this->sommeStat($persos, $club->id, 2, null, [10]));

            //Cadet u18
            $row[] = strval($this->sommeStat($persos, $club->id, 1, null, [11]));

            $row[] = strval($this->sommeStat($persos, $club->id, 2, null, [11]));


            //Junior u20
             $row[] = strval($this->sommeStat($persos, $club->id, 1, null, [4023]));

            $row[] = strval($this->sommeStat($persos, $club->id, 2, null, [4023]));

            //3e Div
             $row[] = strval($this->sommeStat($persos, $club->id, 1, null, [6]));

            $row[] = strval($this->sommeStat($persos, $club->id, 2, null, [6]));

            //2e Div
            $row[] = strval($this->sommeStat($persos, $club->id, null, null, [5]));

            $row[] = strval($this->sommeStat($persos, $club->id, null, null, [8, 4022]));


            //D1 F
            $row[] = strval($this->sommeStat($persos, $club->id, null, null, [6]));

            
            //1er elite II

            $row[] = strval($this->sommeStat($persos, $club->id, 1, null, [4]));

            $row[] = strval($this->sommeStat($persos, $club->id, 2, null, [4]));

            //1er div elite regional
            $row[] = strval($this->sommeStat($persos, $club->id, null, null, [2016]));

            //1er div Federal
             $row[] = strval($this->sommeStat($persos, $club->id, null, null, [3]));

            //2e div Federal
            $row[] = strval($this->sommeStat($persos, $club->id, null, null, [3016]));

            //Arbitre niv I
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2008, [12]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2008, [12]));

            //Arbitre niv II
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2008, [13]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2008, [13]));

            //Arbitre niv III
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2008, [14]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2008, [14]));

            //Entraineur niv I
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2010, [12]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2010, [12]));


            //Entraineur niv II
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2010, [13]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2010, [13]));


            //Entraineur niv III
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2010, [14]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2010, [14]));


            //Docteur niv I
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2011, [12]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2011, [12]));

            //Docteur niv II
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2011, [13]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2011, [13]));

            //Docteur niv III
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2011, [14]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2011, [14]));

            //Prep physique niv I
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2009, [12]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2009, [12]));

            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2009, [12]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2009, [12]));

            //Prep physique niv II
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2009, [13]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2009, [13]));

            //Prep physique niv III
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2009, [14]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2009, [14]));

            //Educateur
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 4, null));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 4, null));
            

            //President
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2, [4017]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2, [4017]));
            
            //Vice President
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2, [4018]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2, [4018]));

            //Tresorier
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2, [4016]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2, [4016]));

            

            //Conseiller
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2, [4020]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2, [4020]));
            //SG
            $row[] = strval($this->sommeStat($persos, $club->id, 1, 2, [4019]));
            $row[] = strval($this->sommeStat($persos, $club->id, 2, 2, [4019]));

            $data[] = $row;
        }

        return $data;
    }

    private function sommeStat($data, $id_club, $id_sexe, $id_type, $id_s_cat)
    {
        $nb = 0;
        $condition = 'return (($stat->id_club == $id_club)';
        if(!is_null($id_sexe)) $condition.= ' && ($stat->id_sexe == $id_sexe)';
        if(!is_null($id_type)) $condition.= ' && ($stat->id_type == $id_type)';
        if(!is_null($id_s_cat)) $condition.= ' && (in_array($stat->id_s_cat, $id_s_cat))';
        $condition.= ');';

        foreach ($data as $key => $stat) {
            if(eval($condition)) {
                $nb += $stat->nb;
            }
        }

        return $nb;
    }
}
*/