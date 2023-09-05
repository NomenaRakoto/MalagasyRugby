<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchRugby extends Model
{
    use HasFactory;

    protected $table = 'match';
    public $timestamps = false;

    protected $fillable = [
        'date_match',
        'heure',
        'id_categorie',
        'nb_essai',
        'joueurs_essai',
        'bonus_offensive',
        'bonus_defensive',
        'nb_blessure',
        'commotion_cerebrale',
        'id_club_home',
        'id_club_guest',
        'terrain',
        'nb_carton_jaune',
        'nb_carton_rouge'
    ];

    protected $primaryKey = 'id';

    public function club_home() {
        return $this->hasOne(Club::class, 'id', 'id_club_home');
    }

    public function club_guest() {
        return $this->hasOne(Club::class, 'id', 'id_club_guest');
    }

    public function categorie() {
        return $this->hasOne(Categorie::class, 'id', 'id_categorie');
    }
}
