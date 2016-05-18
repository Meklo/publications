<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChercheurCreateRequest;
use App\Http\Requests\ChercheurUpdateRequest;
use App\Repositories\ChercheurRepository;

class ChercheursController extends Controller
{
    protected $chercheurRepository;

    protected $nbrPerPage = 10;

    function getInfos()
    {
      return view('form_chercheur');
    }

    function postInfos(ChercheurCreateRequest $request, ChercheurRepository $ChercheurRepository)
    {
      // Array of all inputs : $request-all();
      $ChercheurRepository->save($request->all());

      return view('confirm_chercheur');
    }

    public function __construct(ChercheurRepository $chercheurRepository)
    {
		    $this->chercheurRepository = $chercheurRepository;
	  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
    $chercheurs = $this->chercheurRepository->getPaginate($this->nbrPerPage);
  	$links = $chercheurs->render();

  	return view('chercheurs_liste', compact('chercheurs', 'links'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
      return view('form_chercheur');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ChercheurCreateRequest $request)
  {
      //
      $chercheur = $this->chercheurRepository->store($request->all());

      return view('confirm_chercheur');
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
      $chercheur = $this->chercheurRepository->getById($id);

		  return view('show',  compact('chercheur'));
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
      $chercheur = $this->chercheurRepository->getById($id);

      return view('edit', compact('chercheur'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(ChercheurUpdateRequest $request, $id)
  {
      //
      $this->chercheurRepository->update($id, $request->all());

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
      $this->chercheurRepository->destroy($id);

      return redirect()->back();
  }
}
