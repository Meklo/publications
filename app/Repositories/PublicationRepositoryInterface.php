<?php

namespace App\Repositories;

interface PublicationRepositoryInterface
{
  public function getPaginate($n);
  public function getById($id);
  public function getByTitle($title);
  
  public function destroy($id);
  public function store($inputs);
}
