<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;

use App\Repositories\OrganisationRepository;
use App\Repositories\EquipeRepository;

use App\EloquentModels\Organisation;
use App\EloquentModels\Equipe;

class UsersController extends Controller
{
    protected $userRepository;

    protected $nbrPerPage = 10;

    public function __construct(UserRepository $userRepository)
    {
	$this->userRepository = $userRepository;
        $this->middleware('admin', ['only' => 'destroy']);
        $this->middleware('guest');
    }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
    $users = $this->userRepository->getPaginate($this->nbrPerPage);
  	$links = $users->render();

  	return view('users_liste', compact('users', 'links'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
      $user = $this->userRepository->getById($id);

      $equipeRep = new EquipeRepository($equipe_m = new Equipe());
      $organisationRep = new OrganisationRepository($organisation_m = new Organisation());
      $equipe = $equipeRep->getById($user->equipe);
      $organisation = $organisationRep->getById($equipe->organisation);

		  return view('users_show',  compact('user', 'organisation', 'equipe'));
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
      $this->userRepository->destroy($id);

      return redirect()->back();
  }

}
