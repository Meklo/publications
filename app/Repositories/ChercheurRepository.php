<?php

namespace App\Repositories;

use App\EloquentModels\Chercheur;

class ChercheurRepository implements ChercheurRepositoryInterface
{

  protected $chercheur;

	public function __construct(Chercheur $chercheur)
	{
		$this->chercheur = $chercheur;
	}

  public function getPaginate($n)
	{
		return $this->chercheur->paginate($n);
	}

	public function store($p_chercheur)
	{
		$chercheur = new $this->chercheur;
    $chercheur->first_name = $p_chercheur['first_name'];
    $chercheur->name = $p_chercheur['name'];
    $chercheur->login = $p_chercheur['login'];
    $chercheur->password = $p_chercheur['password'];
    $chercheur->organisation = $p_chercheur['organisation'];
    $chercheur->équipe = $p_chercheur['équipe'];
    if(array_key_exists('admin',$p_chercheur))$chercheur->admin = $p_chercheur['admin'];
    $chercheur->remember_token = $p_chercheur['_token'];
		$chercheur->save();
	}

  public function getById($id)
	{
		return $this->chercheur->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->save($this->getById($id), $inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

}
