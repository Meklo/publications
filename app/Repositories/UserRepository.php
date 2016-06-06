<?php

namespace App\Repositories;

use App\EloquentModels\User;
use App\Repositories\OrganisationRepository;
use App\Repositories\EquipeRepository;

use App\EloquentModels\Organisation;
use App\EloquentModels\Equipe;

class UserRepository implements UserRepositoryInterface
{

  protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

  public function getPaginate($n)
	{
		return $this->user->paginate($n);
	}

	public function store($p_user)
	{
    //var_dump($p_user);
		$user = new $this->user;
    $user->first_name = $p_user['first_name'];
    $user->name = $p_user['name'];
    $user->email = $p_user['email'];
    $user->password = bcrypt($p_user['password']);
    $user->remember_token = $p_user['_token'];


    $equipe = new Equipe();
    $equipeRep = new EquipeRepository($equipe);

    $p_user['organisation'] = strtoupper($p_user['organisation']);

    // Si l'equipe existe on ne l'ajoute pas à la DB
    $equipe_db = $equipeRep->getByName($p_user['equipe']);
    if($equipe_db)
    {
      $user->equipe = $equipe_db->id;
    }else{
      // si l'équipe n'existe pas, on va l'ajouter
      $organisation = new Organisation();
      $organisationRep = new OrganisationRepository($organisation);

      $organisation_db = $organisationRep->getByName($p_user['organisation']);
      if($organisation_db)
      {
        //var_dump($organisation->id);
        $equipe->organisation = $organisation_db->id;
      }else {
        $orga_to_add["name"] = $p_user['organisation'];
        $equipe->organisation = $organisationRep->store($orga_to_add);
      }
      $equipe_to_add["name"] = $p_user['equipe'];
      $equipe_to_add["organisation"] = $equipe->organisation;
      $user->equipe = $equipeRep->store($equipe_to_add);
    }

		$user->save();
	}


  public function getById($id)
	{
		return $this->user->findOrFail($id);
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
