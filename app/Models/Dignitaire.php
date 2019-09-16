<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dignitaire extends Model
{
    protected $primaryKey = 'iddignitaires';
    public $timestamps = false;

    protected $fillable = [
      'nom','postnom','prenom',
      'lieu_naissance','date_naissance','date_deces',
      'nationalite','fonction'
    ];
}
