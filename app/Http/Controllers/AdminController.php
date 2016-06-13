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

    }

    public function index()
    {
      // Accueil du tableau de bord d'administration

      // Nombre total de publications
      $nbpublications = $this->rep_publications->getNbPublications();

      // Nombre total d'utilisateurs
      $nbusers = $this->rep_user->getNbUsers();

      // Le chercheur avec le plus de publications
      $user_nb = $this->rep_user->getUserWithMaxPublications();

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
      
      // article avec deux fois le même auteur
      // article présent deux fois dans la base
      // article dont aucun auteur n'est un chercheur de l'UTT

      return view('admin.kink');
    }




}
