<?php

namespace App\Http\Controllers;

use App\Repositories\EquipeRepository;
use DB;
use Response;

class EquipesController extends Controller
{
    protected $equipeRepository;

    public function __construct(EquipeRepository $equipeRepository)
    {
		    $this->equipeRepository = $equipeRepository;
	  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store()
  {
      //

  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
      $this->equipeRepository->destroy($id);

      return redirect()->back();
  }

  public function getByOrganisation($organisation)
  {
    $options = DB::table('equipes')->where('organisation', $organisation)->lists('name','id');

    return Response::json($options);
  }
}
