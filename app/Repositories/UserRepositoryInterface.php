<?php

namespace App\Repositories;

interface UserRepositoryInterface
{

  public function  store($user);

  public function getPaginate($n);

  public function getById($id);

	public function update($id, Array $inputs);

	public function destroy($id);
}
