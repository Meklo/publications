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
        
        public function getPublicationsByNames($name) {
            $names = explode(' ', $name);
            
            if(count($names) == 2)
            {
                $result = $this->user->where('first_name', 'LIKE', '%'.$names[0].'%')->where('name', 'LIKE', '%'.$names[1].'%')->first();
            
            if($result)
                $result = $result->publications()->get();
            
            return $result;
            }
            else if(count($names) == 1)
            {
                    $result = $this->user->where('first_name', 'LIKE', '%'.$names[0].'%')->orWhere('name', 'LIKE', '%'.$names[0].'%')->first();
            
            if($result)
                $result = $result->publications()->get();
            
            return $result;
            }
            
            return '';
        }
        
        public function getByNames($names)
        {
             if(count($names) == 2)
            {
                $result = $this->user->where('first_name', 'LIKE', '%'.$names[0].'%')->where('name', 'LIKE', '%'.$names[1].'%')->first();
                return $result;
            }
        }

}
