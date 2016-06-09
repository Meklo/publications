<?php

namespace App\Repositories;

interface EquipeRepositoryInterface
{

  public function  store($equipe);

  public function getById($id);

	public function update($id, Array $inputs);

	public function destroy($id);
}
