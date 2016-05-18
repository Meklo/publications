@extends('template_base')

@section('titre')

Inscription

@stop

@section('head')
<link rel="stylesheet" href="../css/base.css">
@stop

@section('blocgauche')
@stop

@section('contenu')
<br>
<div class="panel panel-default">
  <div class="panel-heading"><h4>Nouvel enseignant</h4></div>
  <div class="panel-body">
    {!! Form::open(array('route' => 'chercheur.store')) !!}
    <div class="form-group {!! $errors->has('first_name') ? 'has-error' : '' !!}">
      {!! Form::label('first_name', 'Prénom :') !!}
      {!! Form::text('first_name', null, array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('first_name', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
      {!! Form::label('name', 'Nom :') !!}
      {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="form-group {!! $errors->has('login') ? 'has-error' : '' !!}">
      {!! Form::label('login', 'Login :') !!}
      {!! Form::email('login', null, array('class' => 'form-control', 'placeholder' => 'mail@exemple.fr', 'required' => 'required')) !!}
      {!! $errors->first('login', '<small class="help-block">:message</small>') !!}
      <small>Le login doit être de la forme test@exemple.fr</small>
    </div>
    <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
      {!! Form::label('password', 'Mot de passe :') !!}
      {!! Form::password('password', array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="form-group {!! $errors->has('organisation') ? 'has-error' : '' !!}">
      {!! Form::label('organisation', 'Organisation :')!!}
      {!! Form::text('organisation', null, array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('organisation', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="form-group {!! $errors->has('équipe') ? 'has-error' : '' !!}">
      {!! Form::label('équipe', 'Equipe de recherche :') !!}
      {!! Form::text('équipe', null, array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('équipe', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="form-group">
      {!! Form::label('admin', 'Administrateur :') !!}
      {!! Form::checkbox('admin', 0, false) !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Valider', array('class' => 'btn btn-primary')) !!}
    </div>
    {!! Form::close() !!}
  </div>
</div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
