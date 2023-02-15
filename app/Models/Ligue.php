<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ligue extends Model
{
    use HasFactory;

    protected $table = 'ligue';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'contact',
        'president',
        'vpresident',
        'observation',
        'ctr',
        'adresse',
        'mail_adresse',
        'fb_adresse'
    ];

    protected $primaryKey = 'id';
    
}
