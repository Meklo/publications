<?php

namespace App\Repositories;

use App\EloquentModels\Organisation;
use DB;

class OrganisationRepository implements OrganisationRepositoryInterface
{

  protected $organisation;

	public function __construct(Organisation $organisation)
	{
		$this->organisation = $organisation;
	}

	public function store($p_organisation)
	{
		$organisation = new $this->organisation;
    $organisation->name = $p_organisation['name'];
		$organisation->save();
    return $organisation->id;
	}

  public function getByName($name)
  {
    try {
      $organisation = $this->organisation->where('name', '=', $name)->first();
      return $organisation;
    } catch (ModelNotFoundException $e) {
      return false;
    }
	}

  public function getAll()
	{
		return $this->organisation->all();
	}

  public function getById($id)
	{
		return $this->organisation->findOrFail($id);
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
