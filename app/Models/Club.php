<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $table = 'club';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'contact',
        'responsable',
        'observation',
        'adresse',
        'mail_adresse',
        'fb_adresse',
        'id_section',
        'actif'
    ];

    protected $primaryKey = 'id';

    public function section() {
        return $this->hasOne(Section::class, 'id', 'id_section');
    }
}
