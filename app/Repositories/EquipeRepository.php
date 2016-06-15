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
        
        
      public function getPublicationsEquipe($equipe,$year)
      {       
          $query_results = DB::table('publications')->select('publications.id')
                   ->join('publication_user', 'publications.id', '=', 'publication_user.publication_id')
                   ->join('users', 'publication_user.user_id', '=', 'users.id')
                   ->join('equipes', 'users.equipe', '=', 'equipes.id')
                   ->where('equipes.name', 'LIKE', $equipe)->get();  
          
          $publication =  new \App\EloquentModels\Publication();  
          
          $result = array();
          foreach($query_results as $row)
          {
              array_push($result, $row->id);
          }
         
           return $publication->whereIn('id',$result)->where('year', '>=', $year)->orderBy('publications.year', 'desc');     
        
      }

      public function getPublicationsEquipePaginate($equipe, $year,$n)
      { 
         
          return $this->getPublicationsEquipe($equipe,$year)->paginate($n);
          

          
      }

}
