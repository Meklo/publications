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
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->

<div class="container">
  <div class="col-md-8 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>{{ $tabName }}</h4></div>
      
      @if (count($publications) > 0)
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
            <td><?php $ordre_user=array();
                $id_users = array();
            ?>
                @foreach ($publication->users as $user)
                  <?php
                    // mettre les users dans l'ordre
                      $ordre_user[$user->pivot->ordre] = $user->first_name.' '.$user->name;
                      $id_users[$user->pivot->ordre] = $user->id;
                  ?>
                @endforeach
                <?php
                  ksort($ordre_user);
                  ksort($id_users);
                  
                  $auteurs_tab = array();
                  
                  $iterator = new MultipleIterator;
                  $iterator->attachIterator(new ArrayIterator($ordre_user));
                  $iterator->attachIterator(new ArrayIterator($id_users));
                  
                  foreach ($iterator as $keys => $values) {
                    $auteurs_tab[]= array($values[0], $values[1] ) ;
                  }
                  
                  
                  
                  //$auteur_chaine = implode(', ', $auteurs_tab);

                ?>
                @foreach($auteurs_tab as $lien_auteur)
                    {!! link_to_route('user.publications', $lien_auteur[0], ['id' => $lien_auteur[1]]) !!}
                    <br>
                @endforeach
            </td>
            <td>{{$categories_tab[$publication->type]}}</td>
            <td>{{$publication->year}}</td>
            <td>{!! link_to_route('publication.show', 'Voir', ['id' => $publication->id], ['class' => 'btn btn-default'])!!}</td>
            @if (Auth::check())
                @if(in_array(Auth::user()->id, $id_users))
                     <td>{!! link_to_route('publication.edit', 'Modifier', [$publication->id], ['class' => 'btn btn-primary'])!!}</td>
                @endif
            @endif
          </tr>
        @endforeach
      </table>
      
      @else
      
      <div class="panel-body">
          
          Aucun résultat n'a été retourné
      </div>
      
      @endif
      
      
    </div>
  </div>
</div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
