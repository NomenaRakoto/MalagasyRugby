<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeune extends Model
{
    use HasFactory;

    protected $table = 'personnel';
    public $timestamps = false;

    const JEUNE_CODAGE = 90;

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'id_club',
        'adresse',
        'pere',
        'mere',
        'id_sexe',
        'id_cat',
        'id_etude',
        'identification'
    ];

    protected $primaryKey = 'id';

    public function association() {
        return $this->hasOne(Club::class, 'id', 'id_club');
    }

    public function sexe() {
        return $this->hasOne(Sexe::class, 'id', 'id_sexe');
    }

    public function etude() {
        return $this->hasOne(Etude::class, 'id', 'id_etude');
    }

    public function categorie() {
        return $this->hasOne(Categorie::class, 'id', 'id_cat');
    }

    public function perso_licence()
    {
        $licence = '';
        if($this->association && $this->association->region) $licence.=$this->association->region->id_ligue;
        $licence.=$this->id_club;
        $licence.=self::JEUNE_CODAGE;
        $licence.=$this->id;
        return $licence;
    }


}
