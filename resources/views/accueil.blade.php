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
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                  <h1>Bienvenue</h1>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  <hr>
                  <h3>Test</h3>
                  <p>Lorem ipsum...</p>
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
<p>Créé par Hugo et Guillaume</p>
@stop
