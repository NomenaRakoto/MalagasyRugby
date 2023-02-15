<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatutRegle extends Model
{
    use HasFactory;

    protected $table = 'statut_regle';
    public $timestamps = false;

    protected $fillable = [
        'designation'
    ];

    protected $primaryKey = 'id';
}
