@extends('template_base')

@section('titre')

Inscription

@stop

@section('blocgauche')
@stop

@section('contenu')

<h1>Nouvel enseignant</h1>
{!! Form::open(array('url' => 'nvxenseignant')) !!}
<div class="form-group">
{!! Form::label('prenom', 'Prénom :') !!}
{!! Form::text('prenom', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
{!! Form::label('nom', 'Nom :') !!}
{!! Form::text('nom', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
{!! Form::label('organisation', 'Organisation :')!!}
{!! Form::text('organisation', null, array('class' => 'form-control')) !!}
<div class="form-group">
</div>
{!! Form::label('equipe', 'Equipe de recherche :') !!}
{!! Form::text('equipe', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
{!! Form::label('login', 'Login :') !!}
{!! Form::email('login', null, array('class' => 'form-control', 'placeholder' => 'mail@exemple.fr')) !!}
</div>
<div class="form-group">
{!! Form::label('mdp', 'Mot de passe :') !!}
{!! Form::password('mdp', array('class' => 'form-control')) !!}
</div>
<div class="form-group">
{!! Form::submit('Valider', array('class' => 'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
