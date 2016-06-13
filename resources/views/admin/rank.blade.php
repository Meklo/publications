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
        <li role="presentation" class="active">{{link_to_route('admin.rank','Classement')}}</li>
        <li role="presentation">{{link_to_route('admin.kink','Anomalies')}}</li>
      </ul>
      <br>
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Classement des chercheurs par nombre de publications</h4></div>
        @if(count($users_nb) > 0)
          <table class="table">
            <tr>
              <th>Position</th>
              <th>Profil</th>
              <th>Nombre de publications</th>
            </tr>
            <?php $count = 1; ?>
            @foreach($users_nb as $user)
              <tr>
                <td>{{$count}}</td>
                <td>{!! link_to_route('user.show', $user->first_name.' '.$user->name, [$user->id])!!}</td>
                <td>{!! link_to_route('user.publications', $user->nb, ['id' => $user->id]) !!}</td>
              </tr>
              <?php $count++ ; ?>
            @endforeach
          </table>
        @else
          <div class="panel-body">
            <p>Aucun chercheur n'a publié sur le site.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
