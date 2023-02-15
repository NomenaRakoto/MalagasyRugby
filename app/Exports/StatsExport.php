<?php

namespace App\Exports;

use App\Models\Club;
use App\Models\Personnel;
use Maatwebsite\Excel\Concerns\FromArray;


class StatsExport implements FromArray
{
    public function array(): array
    {
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

    		["Club","ETAT","MINIME U16","","CADET U18","","JUNIOR U20","","3e DIV","","2e DIV U16","","1er ELITE II","",
    		"1er Div Regional","1er Div Federal", 
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
    			"F","",//1er elite II
    			"T",//1er Div Regional
    			"T",//1er Div Federal
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
    		$row[] = ($club->etat == "Actif") ? "A" : "I";
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
    		$row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 8)->count());

    		//1er elite II
    		$row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4)->where('id_sexe',1)->count());
    		$row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 4)->where('id_sexe',2)->count());

    		//1er div elite regional
    		$row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 2016)->count());

    		//1er div Federal
    		$row[] = strval(Personnel::where("id_club", $club->id)->where('id_s_cat', 3)->count());

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
}
