<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $table = 'association';

    protected $fillable = [
        'nom',
        'contact',
        'responsable',
        'observation',
        'adresse',
        'mail_adresse',
        'fb_adresse',
        'id_region',
        'type'
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function region() {
        return $this->hasOne(Ligue::class, 'id', 'id_region');
    }
}
