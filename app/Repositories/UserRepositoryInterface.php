<?php

namespace App\Repositories;

interface UserRepositoryInterface
{

  public function getPaginate($n);

  public function getById($id);

  public function destroy($id);
        
  public function getAll();
  
  public function getPublicationsByNames($name);
  
}
