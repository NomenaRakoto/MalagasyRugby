<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoueursCommotionCerebrale extends Model
{
    use HasFactory;

    protected $table = 'joueurs_commotion_cerebrale';
    public $timestamps = false;

    protected $fillable = [
        'id_match',
        'id_perso'
    ];

    protected $primaryKey = 'id';
}
