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
        <li role="presentation" class="active">{{link_to_route('admin.index','Accueil')}}</li>
        <li role="presentation">{{link_to_route('admin.rank','Classement')}}</li>
        <li role="presentation">{{link_to_route('admin.kink','Anomalies')}}</li>
      </ul>
      <br>
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Publications</h4></div>
          <div class="panel-body">
            <p>Il y a un total de <strong>{{$nbpublications}}</strong> publications sur le site.</p>
          </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Chercheurs</h4></div>
          <div class="panel-body">
            <p>Il y a un total de <strong>{{$nbusers}}</strong> chercheurs sur le site. Le plus actif d'entre eux est {!! link_to_route('user.show', $user_nb["user"]->first_name.' '.$user_nb["user"]->name, [$user_nb["user"]->id])!!} avec un total de <strong>{{$user_nb["nb"]}}</strong> {!! link_to_route('user.publications', 'publications', ['id' => $user_nb["user"]->id]) !!}.</p>
          </div>
      </div>
    </div>
  </div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
