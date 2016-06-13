@extends('template_base')

@section('titre')

Chercheurs

@stop

@section('head')
<link rel="stylesheet" href="./css/base.css">
@stop

@section('blocgauche')
@stop

@section('contenu')
<br>
<div class="container">
  <div class="col-md-8 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Chercheurs</h4></div>

          @if (count($users) > 0)
            <table class="table">
                <tr>
                  <th>Nom</th>
                  <th>Organisation</th>
                  <th></th>
                  <th></th>
                </tr>
              @foreach ($users as $user)
                <tr>
                  <td><strong>{!! link_to_route('user.publications', $user->first_name.' '.$user->name, ['id' => $user->id]) !!}</strong></td>
                  <td>{{$user['relations']['equipe']['relations']['organisation']['attributes']['name']}}</td>
                    @if (Auth::check() and Auth::user()->admin)
                      <td>{!! link_to_route('user.show', 'Voir', [$user->id], ['class' => 'btn btn-primary'])!!}</td>
                      <td>
                				{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
                				    {!! Form::submit('Supprimer', ['class' => 'btn btn-secondary', 'onclick' => 'return confirm(\'Voulez-vous vraiment supprimer ce user ?\')']) !!}
                				{!! Form::close() !!}
                      </td>
                    @else
                      <td colspan="2">{!! link_to_route('user.show', 'Détails', [$user->id], ['class' => 'btn btn-primary'])!!}</td>
                    @endif

                </tr>
              @endforeach
            </table>
          @else
            Aucun chercheur n'a été trouvé
          @endif


    </div>
  </div>
</div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
