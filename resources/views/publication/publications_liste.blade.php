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
<br>

<div class="container">
  <div class="col-md-8 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Publications</h4></div>
        <table class="table">
          <tr>
            <th>Titre</th>
            <th>Auteurs</th>
            <th>Catégorie</th>
            <th>Année</th>
            <th></th>
            <th></th>
          </tr>
        @foreach ($publications as $publication)
          <tr>
            <td><strong>{{$publication->title}}</strong></td>
            <td><?php $ordre_user=array(); ?>
                @foreach ($publication->users as $user)
                  <?php
                    // mettre les users dans l'ordre
                      $ordre_user[$user->pivot->ordre] = $user->first_name.' '.$user->name;
                  ?>
                @endforeach
                <?php
                  ksort($ordre_user);
                  $auteurs_tab = array();
                  foreach ($ordre_user as $key => $value) {
                    $auteurs_tab[]=$value;
                  }
                  $auteur_chaine = implode(', ', $auteurs_tab);

                ?>
                {{ $auteur_chaine }}
            </td>
            <td>{{$categories_tab[$publication->type]}}</td>
            <td>{{$publication->year}}</td>
            <td>{!! link_to_route('publication.show', 'Voir', [$publication->id], ['class' => 'btn btn-primary'])!!}</td>
            <td>
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
