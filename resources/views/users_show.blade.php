@extends('template_base')

@section('titre')

  {{$user->first_name.' '.$user->name}}

@stop

@section('head')
  <link rel="stylesheet" href="../css/base.css">
@stop

@section('blocgauche')
@stop

@section('contenu')
  <br>
  <div class="panel panel-default">
    <div class="panel-heading"><h4>{{$user->first_name.' '.$user->name}}</h4></div>
      <div class="panel-body">
        <p><strong>Email</strong> : {{$user->email}}</p>
        <p><strong>Organisation</strong> : {{$organisation->name}}</p>
        <p><strong>Equipe de recherche</strong> : {{$equipe->name}}</p>
      </div>
  </div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
