<?php

namespace App\Repositories;

use App\EloquentModels\Publication;
use App\Repositories\UserRepository;
use Auth;
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

        public function store($inputs)
	{
            $publicationDB = new $this->publication([
               'title' => $inputs['title'],
                'type' => $inputs['type'],
                'year' => $inputs['year'],
            ]);

            if(isset($inputs['place']))
                $publicationDB->place = $inputs['place'];

            if(isset($inputs['label']))
                $publicationDB->label= $inputs['label'];

            $publicationDB->createur= Auth::user()->id;
            $publicationDB->save();



                if(isset($inputs['user_list']))
                {
                    $orders = explode(',', $inputs['order_author']);

                    $i = 1;
                    foreach ($orders as $order)
                    {
                        $this->publication->users()->attach($order, ['publication_id'=> $publicationDB->id,'ordre' => $i]);
                        $i++;
                    }
                }
	}

        public function getByTitle($title)
        {
            return $this->publication->where('title','LIKE', '%'.$title.'%')->get();
        }

      public function queryWithUsersCateogorie()
      {
          return $this->publication->with('users', 'categorie')
      	     ->orderBy('publications.year', 'desc');
      }

      public function getWithUsersCateogoriePaginate($n)
      {
          return $this->queryWithUsersCateogorie()->paginate($n);
      }
      
      public function update($request, $id)
      {
          
      }
      

}
