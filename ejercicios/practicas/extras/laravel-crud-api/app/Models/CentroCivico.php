<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroCivico extends Model
{

    protected $table = 'CentrosCivicos'; 


    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'nombre', 'direccion', 'telefono', 'horario', 'foto'
    ];
}
