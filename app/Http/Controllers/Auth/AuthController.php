<?php

namespace App\Http\Controllers\Auth;

use App\EloquentModels\User;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Repositories\OrganisationRepository;
use App\Repositories\EquipeRepository;

use App\EloquentModels\Organisation;
use App\EloquentModels\Equipe;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $redirectAfterLogout = '/accueil';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        //$this->middleware('auth', ['except' => 'login']);
    }


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return $this->showRegistrationForm();
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $organisations = Organisation::orderBy('name')->pluck('name', 'id');

        if (property_exists($this, 'registerView')) {
            return view($this->registerView, compact('organisations'));
        }

        return view('auth.register', compact('organisations'));

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|min:2|max:30|alpha',
            'name' => 'required|min:2|max:30|alpha',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed',
            'organisation' => 'required',
            'equipe' => 'required'
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      $equipe = new Equipe();
      $equipeRep = new EquipeRepository($equipe);

      $data['organisation'] = strtoupper($data['organisation']);

      // Si l'equipe existe on ne l'ajoute pas à la DB
      $equipe_db = $equipeRep->getByName($data['equipe']);
      if($equipe_db)
      {
        $data['equipe'] = $equipe_db->id;
      }else{
        // si l'équipe n'existe pas, on va l'ajouter
        $organisation = new Organisation();
        $organisationRep = new OrganisationRepository($organisation);

        $organisation_db = $organisationRep->getByName($data['organisation']);
        if($organisation_db)
        {
          $equipe->organisation = $organisation_db->id;
        }else {
          $orga_to_add["name"] = $data['organisation'];
          $equipe->organisation = $organisationRep->store($orga_to_add);
        }
        $equipe_to_add["name"] = $data['equipe'];
        $equipe_to_add["organisation"] = $equipe->organisation;
        $data['equipe'] = $equipeRep->store($equipe_to_add);
      }

        $user = User::create([
            'first_name' => $data['first_name'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'equipe' => $data['equipe'],
            'remember_token' => $data['_token'],
        ]);

        return $user;
    }
}
