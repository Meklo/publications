<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class Chercheur extends Model
{
    protected $table = 'chercheurs';

    public $timestamps = true;

    public function equipe()
    {
        return $this->belongsTo('App\EloquentModels\Equipe');
    }

}
