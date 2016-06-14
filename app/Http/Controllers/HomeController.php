<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\PublicationRepository;
use App\EloquentModels\Publication;

class HomeController extends Controller
{
    protected $rep_publications;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest');
      $this->middleware('auth', ['except' => 'accueil']);
      $this->rep_publications = new PublicationRepository($publication_m = new Publication());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function accueil()
    {
      $publications = $this->rep_publications->getWithUsersCateogoriePaginate(3);
      return view('accueil', compact('publications'));
    }
}
