<?php

namespace App\Repositories;

use App\EloquentModels\Equipe;
use DB;

class EquipeRepository implements EquipeRepositoryInterface
{

  protected $equipe;

	public function __construct(Equipe $equipe)
	{
		$this->equipe = $equipe;
	}

	public function store($p_equipe)
	{
		$equipe = new $this->equipe;
    $equipe->name = $p_equipe['name'];
    $equipe->organisation = $p_equipe['organisation'];
		$equipe->save();
    return $equipe->id;
	}

  public function getAll()
	{
		return $this->equipe->all();
	}

  public function getById($id)
	{
		return $this->equipe->findOrFail($id);
	}

  public function getByName($name)
  {
    try {
      //$equipe =  $this->equipe->where('name', '=', $name)->firstOrFail();
      $equipe = Equipe::where('name', $name)->first();
      return $equipe;
    } catch (ModelNotFoundException $e) {
      return false;
    }


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
