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

    function getInfos()
    {
      return view('form_user');
    }

    function postInfos(UserCreateRequest $request, UserRepository $userRepository)
    {
      // Array of all inputs : $request-all();
      $userRepository->save($request->all());

      return view('confirm_user');
    }

    public function __construct(UserRepository $userRepository)
    {
		    $this->userRepository = $userRepository;
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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $organisations = Organisation::orderBy('name')->pluck('name', 'id');

      return view('form_user', compact('organisations'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(userCreateRequest $request)
  {
      //
      $user = $this->userRepository->store($request->all());

      return view('confirm_user');
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
      $equipe = $equipeRep->getById($user->id);
      $organisation = $organisationRep->getById($user->id);

		  return view('users_show',  compact('user', 'organisation', 'equipe'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
      $user = $this->userRepository->getById($id);

      return view('edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UserUpdateRequest $request, $id)
  {
      //
      $this->userRepository->update($id, $request->all());

      return redirect('user')->withOk("L'utilisateur " . $request->input('name') . " a été modifié.");
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
