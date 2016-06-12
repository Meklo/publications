@extends('template_base')

@section('titre')
Nouvelle publication
@stop

@section('head')
<link rel="stylesheet" href="css/base.css">
@stop

@section('contenu')
<br/>
<div class="panel panel-default">
  <div class="panel-heading"><h4>Resultats de la recherche</h4></div>
  <div class="panel-body">
      {!! $result !!}
  </div>
</div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop

 

