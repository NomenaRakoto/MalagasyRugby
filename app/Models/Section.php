<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'section';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'contact',
        'president',
        'observation',
        'adresse',
        'mail_adresse',
        'fb_adresse',
        'logo',
        'id_ligue'
    ];

    protected $primaryKey = 'id';

    public function ligue() {
        return $this->hasOne(Ligue::class, 'id', 'id_ligue');
    }
}
