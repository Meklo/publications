<?php

namespace App\Http\Controllers;

use App\EloquentModels\Chercheur;
use App\Http\Requests\ChercheurRequest;

class ChercheursController extends Controller
{
    function getInfos()
    {
      return view('form_chercheur');
    }

    function postInfos(ChercheurRequest $request)
    {
      $chercheur = new Chercheur;
      //$chercheur->chercheur = $request->all();
      $chercheur->first_name = $request->input('first_name');
      $chercheur->name = $request->input('name');
      $chercheur->login = $request->input('login');
      $chercheur->password = $request->input('password');
      $chercheur->organisation = $request->input('organisation');
      $chercheur->équipe = $request->input('équipe');
      $chercheur->save();

      return view('confirm_chercheur');
    }
}
