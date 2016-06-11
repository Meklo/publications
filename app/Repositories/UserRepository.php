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


  public function getById($id)
	{
		return $this->user->findOrFail($id);
	}


	public function destroy($id)
	{
		$this->getById($id)->delete();
	}
        
          public function getAll(){
              return $this->user->get();
          }

}
