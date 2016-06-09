<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $table = 'organisations';

    public $timestamps = false;

    public function equipes()
    {
        return $this->hasMany('App\EloquentModels\Equipe');
    }
}
