<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionJeu extends Model
{
    use HasFactory;

    protected $table = 'position_jeu';
    public $timestamps = false;

    protected $fillable = [
        'designation'
    ];

    protected $primaryKey = 'id';
}
