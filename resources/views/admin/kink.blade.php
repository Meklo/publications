@extends('template_base')

@section('titre')

Administration

@stop

@section('head')
  <link rel="stylesheet" href="./css/base.css">
@stop

@section('blocgauche')
<br>
@stop

@section('contenu')
  <br>
  <div class="container">
    <div class="col-md-11">
      <h1>Administration</h1>
      <ul class="nav nav-tabs">
        <li role="presentation">{{link_to_route('admin.index','Accueil')}}</li>
        <li role="presentation">{{link_to_route('admin.rank','Classement')}}</li>
        <li role="presentation" class="active">{{link_to_route('admin.kink','Anomalies')}}</li>
      </ul>
      <br>
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Anomalies du site</h4></div>
      </div>
    </div>
  </div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
