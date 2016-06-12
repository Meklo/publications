<!DOCTYPE html>
<html lang="fr">
<head>
  <title>@yield('titre')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="{{ csrf_token() }}" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  
  
  <script type="test/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('value')
            }
        });
    });
  </script>
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
      <a class="navbar-brand" href={{URL('/accueil')}}>Publications</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href={{route('user.index')}}>Nos chercheurs</a></li>
        @unless (Auth::guest())
          @if (Auth::user()->admin)
            <li><a href="#">Administration</a></li>
          @endif
          @if (Auth::check())
                  <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Publications <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href={{URL('/publication')}} >Liste des publications</a></li>
                     
                    <li><a href={{URL('/publication/choosetype')}} >Nouvelle publication</a></li>
                   
                </ul>
          </li>
           @endif
        @endunless

        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          {!! Form::open(array('action' => 'SearchController@search', 'id' => 'form_publication_categorie', 'role' => 'search', 'class' => 'navbar-form')) !!}
            <div class="input-group">
            {!! Form::text('recherche', null, array('id' => 'recherche', 'class' => 'form-control', 'placeholder' => 'Rechercher publication')) !!}
            <div class="input-group-btn">
              {!! Form::button('<i class="glyphicon glyphicon-search"></i>', array('class' => 'btn btn-default', 'type' => 'submit')) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </li>
        @if (Auth::guest())
          <li><a href={{URL('/login')}}><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
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

    @yield('pied')

  </body>
</html>
