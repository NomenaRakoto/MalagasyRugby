<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $table = 'personnel';
    public $timestamps = false;

    protected $fillable = [
        'id_type',
        'nom',
        'prenom',
        'date_naissance',
        'cin',
        'id_club',
        'id_s_cat',
        'observation',
        'licence',
        'annee_validite',
        'id_expire',
        'id_sexe',
        'identification',
        'id_format_jeu',
        'id_position_jeu',
        'id_statut_regle_8',
        'id_statut_citoyennete',
        'nb_match_last',
        'id_niveau_equipe',
        'passeport',
        'actif'
    ];

    protected $primaryKey = 'id';

    public function type() {
        return $this->hasOne(Type::class, 'id', 'id_type');
    }

    public function club() {
        return $this->hasOne(Club::class, 'id', 'id_club');
    }

    public function scat() {
        return $this->hasOne(Scat::class, 'id', 'id_s_cat');
    }

    public function sexe() {
        return $this->hasOne(Sexe::class, 'id', 'id_sexe');
    }

    public function format_jeu() {
        return $this->hasOne(FormatJeu::class, 'id', 'id_format_jeu');
    }

    public function position_jeu() {
        return $this->hasOne(PositionJeu::class, 'id', 'id_position_jeu');
    }

    public function statut_regle() {
        return $this->hasOne(StatutRegle::class, 'id', 'id_statut_regle_8');
    }

    public function statut_citoyennete() {
        return $this->hasOne(StatutCitoyennete::class, 'id', 'id_statut_citoyennete');
    }

    public function niveau_equipe() {
        return $this->hasOne(NiveauEquipe::class, 'id', 'id_niveau_equipe');
    }

    public function perso_licence()
    {
    	$licence = '';
    	if($this->club && $this->club->section) $licence.=$this->club->section->id_ligue;
    	if($this->club) $licence.=$this->club->id_section;
    	$licence.=$this->id_club;
    	if($this->type) $licence.=$this->type->codage;
    	$licence.=$this->licence;
    	return $licence;
    }
}
