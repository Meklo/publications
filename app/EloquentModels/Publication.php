<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publications';
    
    public $timestamps = false;
    
    public function categorie()
    {
        return $this->belongsTo('App\EloquenModels\Categorie');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\EloquentModels\User');
    }

}
