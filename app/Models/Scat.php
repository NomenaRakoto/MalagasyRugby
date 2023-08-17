<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scat extends Model
{
    use HasFactory;

    protected $table = 'scat';
    public $timestamps = false;

    protected $fillable = [
        'designation',
        'min_age',
        'max_age',
        'id_sexe',
        'id_cat',
        'id_type'
    ];

    protected $primaryKey = 'id';

    public function categorie() {
        return $this->hasOne(Categorie::class, 'id', 'id_cat');
    }

    public function sexe() {
        return $this->hasOne(Sexe::class, 'id', 'id_sexe');
    }

    public function type() {
        return $this->hasOne(Type::class, 'id', 'id_type');
    }
}
