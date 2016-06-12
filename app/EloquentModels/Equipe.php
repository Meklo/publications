<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $table = 'equipes';

    public $timestamps = false;

    protected $fillable = array('name', 'organisation');

    public function users()
    {
        return $this->hasMany('App\EloquentModels\User');
    }

    public function organisation()
    {
        return $this->belongsTo('App\EloquentModels\Organisation', 'organisation', 'id');
    }

}
