@extends('template_base')

@section('titre')
Nouvelle publication
@stop

@section('head')
<link rel="stylesheet" href="css/base.css">
@stop

@section('contenu')
<br>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading"><h4>Choississez un type de publication</h4></div>
  <div class="panel-body">
     {!! Form::open(array( 'url' => 'publication/choosetype' , 'id' => 'form_publication_categorie')) !!}
     
    <div class="form-group {!! $errors->has('sigle') ? 'has-error' : '' !!}">
      {!! Form::label('sigle', 'Type de publication :') !!}
      {!! Form::select('type', $categories) !!}
      {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
    </div>
       
    <div class="form-group">
      {!! Form::submit('Suivant', array('class' => 'btn btn-primary', 'id' => 'btn_submit')) !!}
    </div>
    {!! Form::close() !!}
  </div>
</div>

</div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop

 