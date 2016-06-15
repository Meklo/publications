@extends('template_base')

@section('titre')
Nouvelle publication
@stop

@section('head')
<link rel="stylesheet" href="css/base.css">
@stop

@section('contenu')
<br>
<div class="panel panel-default">
  <div class="panel-heading"><h4>Sélectionnez une équipe et une année à partir de laquelle lancer votre recherche</h4></div>
  <div class="panel-body">
     {!! Form::open(array( 'url' => 'publication/choosetype' , 'id' => 'form_publication_categorie')) !!}
     
     <div class='form-inline'>
        <div class="form-group {!! $errors->has('equipe') ? 'has-error' : '' !!}">
       
        </div>
        <div class="form-group {!! $errors->has('year') ? 'has-error' : '' !!}">
          
        </div>

        
     </div>
     <div class='form-inline'>
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