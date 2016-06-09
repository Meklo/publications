<?php

namespace App\Repositories;

interface CategorieRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function destroy($id);
    public function getBySigle($sigle);
}

