@extends('template_base')

@section('titre')



@stop

@section('head')
<link rel="stylesheet" href="./css/base.css">
@stop

@section('blocgauche')
@stop

@section('contenu')
<br>
<div class="panel panel-default">
  <div class="panel-heading"><h4>Chercheurs</h4></div>
    <table class="table">
    @foreach ($chercheurs as $chercheur)
      <tr>
        <td><strong>{{$chercheur->first_name.' '.$chercheur->name}}</strong></td>
        <td>{!! link_to_route('chercheur.show', 'Voir', [$chercheur->id], ['class' => 'btn btn-primary btn-block'])!!}</td>
        <td>
  				{!! Form::open(['method' => 'DELETE', 'route' => ['chercheur.destroy', $chercheur->id]]) !!}
  				    {!! Form::submit('Supprimer', ['class' => 'btn btn-secondary btn-block', 'onclick' => 'return confirm(\'Voulez-vous vraiment supprimer ce chercheur ?\')']) !!}
  				{!! Form::close() !!}
				</td>
      </tr>
    @endforeach
  </table>
  </div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
