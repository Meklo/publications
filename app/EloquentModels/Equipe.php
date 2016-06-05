<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $table = 'equipes';

    public $timestamps = false;

    public function chercheurs()
    {
        return $this->hasMany('App\EloquentModels\Chercheur');
    }

    public function organisation()
    {
        return $this->belongsTo('App\EloquentModels\Organisation');
    }

}
