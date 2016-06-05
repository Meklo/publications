<?php

namespace App\Repositories;

interface ChercheurRepositoryInterface
{

  public function  store($chercheur);

  public function getPaginate($n);

  public function getById($id);

	public function update($id, Array $inputs);

	public function destroy($id);
}
