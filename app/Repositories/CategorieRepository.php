<?php

namespace App\Repositories;

use App\EloquentModels\Categorie;

use App\Repositories\PublicationRepository;
use App\EloquentModels\Publication;


class CategorieRepository implements CategorieRepositoryInterface
{

  protected $categorie;

	public function __construct(Categorie $categorie)
	{
		$this->categorie = $categorie;
	}

        public function getAll()
	{
		return $this->categorie->get();
	}


        public function getById($id)
	{
		return $this->categorie->findOrFail($id);
	}


	public function destroy($id)
	{
		$this->getById($id)->delete();
	}
        
        public function getBySigle($sigle) {
            
            return $this->categorie->where('sigle', $sigle)->first();
            
        }

}
