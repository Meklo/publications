<?php

namespace App\Repositories;

use App\EloquentModels\Publication;
use App\Repositories\UserRepository;

use App\EloquentModels\User;


class PublicationRepository implements PublicationRepositoryInterface
{

  protected $publication;

	public function __construct(Publication $publication)
	{
		$this->publication = $publication;
	}

  public function getPaginate($p)
	{
		return $this->publication->paginate($p);
	}


  public function getById($id)
	{
		return $this->publication->findOrFail($id);
	}


	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

}