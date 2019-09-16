<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Titre extends Model
{
    protected $primaryKey = 'idtitres';
    public $timestamps = false;

    protected $fillable = [
      'iddignitaires','idmedailles','date_decoration','num_brevet'
    ];
    

    public static function scopeJoinDignitaire($query){

        return $query->join('dignitaires','dignitaires.iddignitaires','=','titres.iddignitaires');               
    }

    public static function scopeJoinMedaille($query){

        return $query->join('medailles','medailles.idmedailles','=','titres.idmedailles');               
    }
}
