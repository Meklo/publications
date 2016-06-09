<?php

namespace App\Repositories;

interface OrganisationRepositoryInterface
{

  public function  store($organisation);

  public function getById($id);

	public function update($id, Array $inputs);

	public function destroy($id);
}
