<?php

namespace App\Repositories;

interface PublicationRepositoryInterface
{

  public function getPaginate($n);

  public function getById($id);

	public function destroy($id);
}
