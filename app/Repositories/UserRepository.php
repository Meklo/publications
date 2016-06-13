<?php

namespace App\Repositories;

use App\EloquentModels\User;
use App\Repositories\OrganisationRepository;
use App\Repositories\EquipeRepository;

use App\EloquentModels\Organisation;
use App\EloquentModels\Equipe;

use DB;

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

  public function queryWithEquipe()
  {
      return $this->user->with('equipe', 'equipe.organisation');
  }

  public function getWithEquipePaginate($n)
  {
      return $this->queryWithEquipe()->paginate($n);
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

   public function getNbUsers()
   {
     return $result = $this->user->count();
   }

   public function getUserWithMaxPublications()
   {
     $subQuery = DB::table('publication_user')
               ->selectRaw('user_id, COUNT(*) as nb')
               ->groupBy('user_id');

      $id = DB::table('publication_user')
                ->selectRaw('user_id, MAX(nb) as nb')
                ->from(DB::raw(' ( ' . $subQuery->toSql() . ' ) publication_user') )
                ->mergeBindings($subQuery)
                ->get();
    $user_nbpub = array();
    $user_nbpub['nb']=$id[0]->nb;
    $user_nbpub['user'] = $this->getById($id[0]->user_id);
    return $user_nbpub;
   }

   public function getUsersWithDescNbPublications()
   {
    return DB::table('users')
              ->selectRaw('users.id, users.first_name, users.name,COUNT(*) as nb')
              ->join('publication_user','users.id', '=', 'publication_user.user_id')
              ->groupBy('publication_user.user_id')
              ->orderBy('nb','desc')
              ->get();

   }
}
