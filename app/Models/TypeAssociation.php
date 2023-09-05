<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAssociation extends Model
{
    use HasFactory;

    protected $table = 'type_association';
    public $timestamps = false;

    protected $fillable = [
        'designation'
    ];

    protected $primaryKey = 'id';
}
