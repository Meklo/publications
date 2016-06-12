@extends('template_base')

@section('titre')

Publications

@stop

@section('head')
<link rel="stylesheet" href="./css/base.css">
@stop

@section('blocgauche')
@stop

@section('contenu')

    <h2>Détails de la publication</h2>
    <br>
  <div class="container">
    <div class="col-md-8 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"><h4>{{$publication->title }}</h4></div>
          <div class="panel-body">
            <p><strong>Categorie</strong> : {{ $categorie }}</p>
            <p><strong>Année de publication</strong> : {{$publication->year}}</p>
            
            @if ($publication->type == 'RI' || $publication->type == 'RF' || $publication->type == 'CI' || $publication->type == 'CF' || $publication->type == 'OS' )
            
            <p><strong>Label</strong> : {{$publication->label}}</p>
            
            @endif
            @if ( $publication->type == 'CI' || $publication->type == 'CF')
            
            <p><strong>Lieu</strong> : {{$publication->place}}</p>
            
            @endif
          </div>
      </div>
    </div>
  </div>

<h2>Auteurs de la publication </h2>

  @foreach($auteurs as $user)
      <br>
        <div class="container">
          <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
              <div class="panel-heading"><h4>{{$user->first_name.' '.$user->name}}</h4></div>
                <div class="panel-body">
                  <p><strong>Email</strong> : {{$user->email}}</p>
                  <p><strong>Organisation</strong> : {{$user->equipe()->first()->organisation()->first()->name}}</p>
                  <p><strong>Equipe de recherche</strong> : {{$user->equipe()->first()->name}}</p>
                </div>
            </div>
          </div>
        </div>
  @endforeach



@stop