<!DOCTYPE html>
<html lang="fr">
<head>
  <title>@yield('titre')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="{{ csrf_token() }}" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  @yield('head')
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Publications</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="accueil">Accueil</a></li>
        <li><a href="#">A propos</a></li>
        <li><a href="#">Contacter</a></li>
        @unless (Auth::guest())
          @if (Auth::user()->admin)
            <li><a href="#">Administration</a></li>
          @endif
        @endunless
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <form class="navbar-form" role="search">
            <div class="input-group">
            <input class="form-control" id="recherche" placeholder="Rechercher">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
          </form>
        </li>
        @if (Auth::guest())
          <li><a href="login"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
        @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                      {{Auth::user()->first_name.' '.Auth::user()->name }} <span class="caret"></span>
                                  </a>

          <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Déconnexion</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
  <div class="row content">
      <div class="col-sm-2 sidenav">
        @yield('blocgauche')
      </div>
      <div class="col-sm-8 text-left">
        @yield('contenu')
      </div>
      <div class="col-sm-2 sidenav">
        @yield('blocdroit')
        <!-- <div class="well">
          <p>Rectangle</p>
        </div> -->
      </div>
    </div>
  </div>

  <footer class="container-fluid text-center">
    <script type="test/javascript">
      $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('value')
              }
          });
      });
    </script>
    @yield('pied')
  </footer>

  </body>
</html>
