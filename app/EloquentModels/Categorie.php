<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';
    
    public $timestamps = false;
    
    public function publications()
    {
        return $this->hasMany('App\EloquenModels\Publication');
    }
}
