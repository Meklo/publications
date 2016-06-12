<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = ['first_name', 'name', 'email', 'password', 'equipe', 'remember_token'];

    public function equipe()
    {
        return $this->belongsTo('App\EloquentModels\Equipe', 'equipe', 'id');
    }

    public function publications()
    {
        return $this->belongsToMany('App\EloquentModels\Publication');
    }

}
