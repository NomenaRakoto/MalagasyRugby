<?php
use App\Models\Config;

if(!function_exists('fmr_name')) {
	function fmr_name()
	{
		return Config::where('varname', 'nom_federation')->first()->value;
	}
}

if(!function_exists('fmr_acronyme')) {
	function fmr_acronyme()
	{
		return Config::where('varname', 'acronyme_federation')->first()->value;
	}
}

if(!function_exists('saison')) {
	function saison()
	{
		return Config::where('varname', 'saison')->first()->value;
	}
}