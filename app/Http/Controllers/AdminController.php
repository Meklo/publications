<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\PublicationRepository;
use App\EloquentModels\Publication;

use App\Repositories\UserRepository;
use App\EloquentModels\User;

class AdminController extends Controller
{

    protected $rep_user;
    protected $rep_publications;

    public function __construct()
    {
         $this->rep_user = new UserRepository($user_m = new User());
         $this->rep_publications = new PublicationRepository($publication_m = new Publication());
         $this->middleware('admin');
    }

    public function index()
    {
      // Accueil du tableau de bord d'administration

      // Nombre total de publications
      $nbpublications = $this->rep_publications->getNbPublications();

      // Nombre total d'utilisateurs
      $nbusers = $this->rep_user->getNbUsers();

      // Le chercheur avec le plus de publications
      $user_nb = array();
      if($nbpublications > 0)
      {
          $user_nb = $this->rep_user->getUserWithMaxPublications();
      }


      return view('admin.index', compact('nbpublications', 'nbusers','user_nb'));

    }

    public function rank()
    {
      // Classement des users par nombre de publications
      $users_nb = $this->rep_user->getUsersWithDescNbPublications();
      return view('admin.rank', compact('users_nb'));
    }

    public function kink()
    {
      // Liste des anomalies

      // publication avec deux fois le même auteur
      $doublons = $this->rep_user->getDoublonUserPublication();
      $list_doublons_users = array();
      $count = 0;
      foreach ($doublons as $doublon) {
        $list_doublons_users[$count]['publication'] = $this->rep_publications->getById($doublon->publication_id);
        $list_doublons_users[$count]['user'] = $this->rep_user->getById($doublon->user_id);
        $count++;
      }

      // publication présente deux fois dans la base
      $list_doublons_publications = $this->rep_publications->getDoublonsPublication();

      return view('admin.kink', compact('list_doublons_users','list_doublons_publications'));
    }




}
