@extends('template_base')

@section('titre')

Inscription

@stop

@section('head')
<link rel="stylesheet" href="../../css/base.css">
<script>
  jQuery(document).ready(function($) {

          // Populate equipe
          $('#organisation').change(function(){
            var id_organisation = $('#organisation_data').find('option[value='+$('#organisation').val()+']').attr('id');
            if($.isNumeric(id_organisation))
            {
              $.get("create/complete_equipe/"+id_organisation,
              function(data) {
                  var numbers = $('#equipe_data');
                  numbers.empty();
                  $.each(data, function(key, value) {
                      numbers.append($("<option>")
                      .attr("value",value)
                      .attr("id", key)
                      );
                  });
              });
            }else {
              $('#equipe_data').empty();
            }
          });

  });
</script>
@stop

@section('blocgauche')
@stop

@section('contenu')
<br>
<div class="panel panel-default">
  <div class="panel-heading"><h4>Nouvel enseignant</h4></div>
  <div class="panel-body">
    {!! Form::open(array('url' => URL(/register), 'id' => 'form_user')) !!}
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
    <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
      {!! Form::label('password_confirmation', 'Confirmation du mot de passe :') !!}
      {!! Form::password('password_confirmation', array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('password_confirmation', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="form-group {!! $errors->has('organisation') ? 'has-error' : '' !!}">
      {!! Form::label('organisation', 'Organisation :')!!}
      {!! Form::datalist('organisation','organisation_data', 'form-control', $organisations) !!}
      {!! $errors->first('organisation', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="form-group {!! $errors->has('equipe') ? 'has-error' : '' !!}s">
      {!! Form::label('equipe', 'Equipe de recherche :') !!}
      {!! Form::datalist('equipe','equipe_data', 'form-control', '') !!}
      {!! $errors->first('equipe', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Valider', array('class' => 'btn btn-primary', 'id' => 'btn_submit')) !!}
    </div>
    {!! Form::close() !!}
  </div>
</div>

@stop

@section('blocdroit')
@stop

@section('pied')
@stop
