<?php

namespace App\Repositories;

use App\EloquentModels\Chercheur;
use App\Repositories\OrganisationRepository;
use App\Repositories\EquipeRepository;

use App\EloquentModels\Organisation;
use App\EloquentModels\Equipe;

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
    //var_dump($p_chercheur);
		$chercheur = new $this->chercheur;
    $chercheur->first_name = $p_chercheur['first_name'];
    $chercheur->name = $p_chercheur['name'];
    $chercheur->login = $p_chercheur['login'];
    $chercheur->password = $p_chercheur['password'];
    $chercheur->remember_token = $p_chercheur['_token'];


    $equipe = new Equipe();
    $equipeRep = new EquipeRepository($equipe);

    $p_chercheur['organisation'] = strtoupper($p_chercheur['organisation']);

    // Si l'equipe existe on ne l'ajoute pas à la DB
    $equipe_db = $equipeRep->getByName($p_chercheur['equipe']);
    if($equipe_db)
    {
      $chercheur->equipe = $equipe_db->id;
    }else{
      // si l'équipe n'existe pas, on va l'ajouter
      $organisation = new Organisation();
      $organisationRep = new OrganisationRepository($organisation);

      $organisation_db = $organisationRep->getByName($p_chercheur['organisation']);
      if($organisation_db)
      {
        //var_dump($organisation->id);
        $equipe->organisation = $organisation_db->id;
      }else {
        $orga_to_add["name"] = $p_chercheur['organisation'];
        $equipe->organisation = $organisationRep->store($orga_to_add);
      }
      $equipe_to_add["name"] = $p_chercheur['equipe'];
      $equipe_to_add["organisation"] = $equipe->organisation;
      $chercheur->equipe = $equipeRep->store($equipe_to_add);
    }


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
