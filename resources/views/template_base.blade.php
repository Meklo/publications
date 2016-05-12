<!DOCTYPE html>
<html lang="fr">
<head>
  <title>@yield('titre')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/base.css">
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
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
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
    @yield('pied')
  </footer>

  </body>
</html>
