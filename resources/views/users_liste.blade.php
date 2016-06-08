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
        <table class="table">
        @foreach ($users as $user)
          <tr>
            <td><strong>{{$user->first_name.' '.$user->name}}</strong></td>
            <td>{!! link_to_route('user.show', 'Voir', [$user->id], ['class' => 'btn btn-primary'])!!}</td>
            <td>
              @if (Auth::check() and Auth::user()->admin)
        				{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
        				    {!! Form::submit('Supprimer', ['class' => 'btn btn-secondary', 'onclick' => 'return confirm(\'Voulez-vous vraiment supprimer ce user ?\')']) !!}
        				{!! Form::close() !!}
              @endif
    				</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
