@extends('template_base')

@section('titre')
Accueil
@stop

@section('head')
<link rel="stylesheet" href="css/base.css">
@stop

@section('blocgauche')
<p><a href="#">Lien 1</a></p>
<p><a href="#">Lien 2</a></p>
<p><a href="#">Lien 3</a></p>
@stop

@section('contenu')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                  <h1>Les recherches de l'UTT</h1>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="container">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                  <h1>Les dernières publications</h1>
                  <hr>
                  <div class="col-md-4 col-md-offset">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h2>Publication 1</h2>
                        <hr>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-md-offset">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h2>Publication 2</h2>
                        <hr>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-md-offset">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h2>Publication 3</h2>
                        <hr>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@stop

@section('blocdroit')
<div class="well">
  <p>Rectangle</p>
</div>
@stop

@section('pied')
@stop
