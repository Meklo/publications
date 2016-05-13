<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChercheurRequest;

class ChercheursController extends Controller
{
    function getInfos()
    {
      return view('form_chercheur');
    }

    function postInfos(ChercheurRequest $request)
    {
      return view('confirm_chercheur');
    }
}
