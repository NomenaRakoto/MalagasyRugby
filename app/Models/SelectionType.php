<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectionType extends Model
{
    use HasFactory;

    protected $table = 'selection_type';
    public $timestamps = false;

    protected $fillable = [
        'designation'
    ];

    protected $primaryKey = 'id';
}
