<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    use HasFactory;

    protected $table = 'mutation';
    public $timestamps = false;

    protected $fillable = [
        'date_mutation',
        'id_joueur',
        'id_ancien_club',
        'id_new_club',
        'motif'
    ];

    protected $primaryKey = 'id';

    public function joueur() {
        return $this->hasOne(Personnel::class, 'id', 'id_joueur');
    }

    public function club_depart() {
        return $this->hasOne(Club::class, 'id', 'id_ancien_club');
    }

    public function club_arrive() {
        return $this->hasOne(Club::class, 'id', 'id_new_club');
    }
}
